package boboExplicacion;

import java.io.IOException;
import java.io.ObjectInputStream;
import java.net.ServerSocket;
import java.net.Socket;

public class Servidor {

    public static void main(String[] args) {

        final int PUERTO = 9000;
        String mensaje = "";

        try (ServerSocket servidor = new ServerSocket(PUERTO);
             Socket cliente = servidor.accept();
             ObjectInputStream ois = new ObjectInputStream(cliente.getInputStream());) {

            System.out.println("Servidor iniciado");

            while (true) {

                mensaje = (String) ois.readObject();

                if (mensaje.equalsIgnoreCase("exit")) {
                    break;
                } else {
                    System.out.println("Cliente: " + mensaje);
                }

            }

        } catch (Exception e) {
            e.printStackTrace();
        }

        System.out.println("Servidor cerrado.");

    }

}
