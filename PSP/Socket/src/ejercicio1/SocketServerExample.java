package ejercicio1;

import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.lang.ClassNotFoundException;
import java.net.ServerSocket;
import java.net.Socket;

/**
 * This class implements java Socket server
 *
 * @author pankaj
 * @url https://www.journaldev.com/741/java-socket-programming-server-client
 */
public class SocketServerExample {

    //static ServerSocket variable
    private static ServerSocket serverSocketFactory;
    //socket server port on which it will listen
    private static int port = 9876;

    public static void main(String args[]) {

        try {
            // Creamos la "fábrica" de sockets del lado del servidor para conectarnos con los clientes,
            // y lo vinculamos a un puerto TCP local (el correspondiente al número 'port').
            serverSocketFactory = new ServerSocket(port);

            // listens indefinitely until it receives an 'exit' call or program terminates
            while (true) {
                System.out.println("\nEsperando petición de conexión de cliente...");


                // Seguimos el esquema de TCP: primero se establece una conexión.
                // Para ello, el servidor debe tener abierto un puerto TCP (con su respectivo socket en el lado de Java)
                // por donde pueda recibir peticiones de conexión por parte de clientes.
                // Creamos el socket del servidor y permanecemos a la escucha de peticiones de conexión por parte de clientes.
                // accept() es un método bloqueante: hasta que llegue una petición, el servidor se quedará esperando aquí:
                Socket socket_servidor = serverSocketFactory.accept();

                //read from socket to ObjectInputStream object
                ObjectInputStream flujo_de_entrada = new ObjectInputStream(socket_servidor.getInputStream());

                // InputStreamReader flujoDeEntradaDeStrings;

                //convert ObjectInputStream object to String
                // (este 'cast' no haría falta con InputStreamReader, pues el método read de esta clase trabaja con arrays de caracteres).
                String mensaje_recibido = (String) flujo_de_entrada.readObject();
                System.out.println("Mensaje recibido del CLIENTE:  " + mensaje_recibido);

                //create ObjectOutputStream object
                ObjectOutputStream flujo_de_salida = new ObjectOutputStream(socket_servidor.getOutputStream());

                char idCliente = mensaje_recibido.charAt(mensaje_recibido.length() - 2);
                //write object to Socket
                flujo_de_salida.writeObject("Hola, cliente " + idCliente + " ... Adiós, cliente " + idCliente + ".");

                //close resources
                flujo_de_entrada.close();
                flujo_de_salida.close();
                socket_servidor.close();

                //terminate the server if client sends exit request
                if (mensaje_recibido.equalsIgnoreCase("exit")) break;
            }

            System.out.println("¡Cerrando el socket del servidor!");
            // Cerramos el objeto ServerSocket:
            serverSocketFactory.close();

        } catch (IOException ioe) {
            ioe.printStackTrace();
        } catch (ClassNotFoundException cnfe) {
            System.out.println("El cliente ha enviado algo que no es un String.");
            cnfe.printStackTrace();
        }
    }

}