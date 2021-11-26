package boboExplicacion;

import com.sun.source.tree.TryTree;

import java.io.ObjectOutputStream;
import java.net.Socket;
import java.util.Scanner;

public class Cliente {

    public static void main(String[] args) {

        final int PUERTO = 9000;
        final String DIRECCION = "localhost";
        Scanner scanner = new Scanner(System.in);
        String mensaje = "";

        try(Socket cliente = new Socket(DIRECCION,PUERTO);
            ObjectOutputStream oos = new ObjectOutputStream(cliente.getOutputStream())){

            while (true){

                System.out.print(">");
                mensaje = scanner.nextLine();

                if (mensaje.equalsIgnoreCase("exit")){
                    break;
                }else {
                    oos.writeObject(mensaje);
                }

            }

        }catch (Exception e){

            e.printStackTrace();

        }

    }

}
