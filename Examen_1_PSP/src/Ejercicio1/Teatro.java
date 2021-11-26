package Ejercicio1;

import java.io.IOException;
import java.net.ServerSocket;
import java.util.ArrayList;

public class Teatro {

    private static int contador = 0;

    public static void main(String[] args) {

        try (ServerSocket servidor = new ServerSocket(9000);){
            System.out.println("Teatro abierto");

            Conexion mostrador1 = new Conexion(servidor);
            Conexion mostrador2 = new Conexion(servidor);

            mostrador1.start();
            mostrador2.start();

        } catch (IOException e) {

        }

    }

    public static synchronized void sumarEntrada(){
        if (isAvailable())
            contador++;
        System.out.println("Entrada comprada. Quedan " + (50-contador));

    }
    public static boolean isAvailable(){
        if (contador>=0 && contador<50) return true;
        else return false;
    }

    public static boolean isSoldOut(){
        if (contador>=0 && contador<50) return false;
        else return true;
    }

}
