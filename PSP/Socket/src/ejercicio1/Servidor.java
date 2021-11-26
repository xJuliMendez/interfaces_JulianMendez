package ejercicio1;

import java.io.IOException;
import java.net.ServerSocket;
import java.net.Socket;
import java.util.TreeMap;

public class Servidor {


    public static void main(String[] args) {

        final int puerto = 9000;
        boolean isAlive = true;

        try(ServerSocket servidor = new ServerSocket(puerto);){

            System.out.println("Servidor iniciado!");

            Comunicacion comunicacion1 = new Comunicacion(servidor);
            Comunicacion comunicacion2 = new Comunicacion(servidor);

            comunicacion1.start();
            comunicacion2.start();

            while (isAlive){
                if(!areALive(comunicacion1,comunicacion2)){
                    isAlive = false;
                }
            }

        }catch (Exception e){
            System.out.println("Ha ocurrido un error");
        }

    }

    public static boolean areALive(Thread hilo1, Thread hilo2){

        if (hilo1.isAlive() && hilo2.isAlive()) return true;
        else return false;
    }

}
