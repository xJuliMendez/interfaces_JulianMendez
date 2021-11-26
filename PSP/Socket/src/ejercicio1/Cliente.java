package ejercicio1;

import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.io.OutputStream;
import java.net.Socket;
import java.net.UnknownHostException;
import java.util.Scanner;

public class Cliente {

    public static void main(String[] args) {

        final int PUERTO = 9000;
        String infoInicial = "";
        boolean isAlive = true;
        Scanner scanner = new Scanner(System.in);
        String mensaje = "";

        try(Socket cliente = new Socket("localhost",PUERTO);

            ObjectOutputStream oos = new ObjectOutputStream(cliente.getOutputStream())) {

            infoInicial = "Puerto local: " + cliente.getLocalPort()
            + "\nPuerto remoto: " + cliente.getPort()
            + "\nDireccion IP del servidor: " + cliente.getInetAddress();

            oos.writeObject(infoInicial);

            while (isAlive){

                System.out.print(">");
                mensaje = scanner.nextLine();
                if (mensaje.equalsIgnoreCase("exit")){
                    isAlive = false;
                }else {
                    oos.writeObject(mensaje);
                }

            }

        } catch (UnknownHostException e) {
            e.printStackTrace();
        } catch (IOException e) {
            e.printStackTrace();
        }

    }

}
