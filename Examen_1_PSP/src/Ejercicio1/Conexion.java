package Ejercicio1;

import java.io.ObjectInput;
import java.io.ObjectInputStream;
import java.net.ServerSocket;
import java.net.Socket;

public class Conexion extends Thread{

    private ServerSocket servidor;

    public Conexion(ServerSocket servidor){
        this.servidor = servidor;
    }

    public void run() {

        String mensaje = "";

        while(true){
            if (!Teatro.isSoldOut()){
                try (Socket cliente = servidor.accept();
                     ObjectInputStream oos = new ObjectInputStream(cliente.getInputStream())){
                    System.out.println("Atendiendo filosofo");
                    while (true){
                        mensaje = (String) oos.readObject();

                        if (mensaje.equalsIgnoreCase("Compro una entrada")){
                            Teatro.sumarEntrada();
                        }else if (mensaje.equalsIgnoreCase("Muchas gracias, me voy")){
                            break;
                        }
                    }

                }catch (Exception e){

                }
            }else{
                System.out.println("Cerrando taquillas está todo vendido");
                break;
            }
        }

    }

}
