package ejercicio1;

import java.io.IOException;
import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.net.InetAddress;
import java.net.Socket;
import java.net.UnknownHostException;

/**
 * This class implements java socket client
 * @author pankaj
 *
 */
public class SocketClientExample {

    public static void main(String[] args) throws IOException, ClassNotFoundException, InterruptedException{

        // Obtenemos la dirección IP del servidor:
        // - Si el servidor está en la misma máquina que el cliente, obtenemos la dirección "localhost". (Es el caso del presente ejemplo.)
        // - Si (lo más común) el servidor está en otra máquina, con otra dirección IP, ésta es la que necesitamos.

        // Creamos el socket del lado del cliente:
        Socket socket_cliente = null;

        // Creamos los recursos del socket del lado del cliente:
        ObjectOutputStream flujo_de_salida = null;
        ObjectInputStream flujo_de_entrada = null;

        for(int i=0; i<5;i++){

            // Solicitamos conexión del socket cliente al socket servidor
            socket_cliente = new Socket("localhost", 9876);

            // Escribimos en el socket usando ObjectOutputStream
            flujo_de_salida = new ObjectOutputStream(socket_cliente.getOutputStream());
            System.out.println("\nEnviando petición al socket del servidor...");

            if (i==4) flujo_de_salida.writeObject("exit");  // El quinto cliente envía al servidor una petición para cerrar la conexión.
            else flujo_de_salida.writeObject("Hola, soy el cliente " + i + ".");

            // Leemos el mensaje de respuesta que da el servidor
            flujo_de_entrada = new ObjectInputStream(socket_cliente.getInputStream());
            String mensaje_del_servidor = (String) flujo_de_entrada.readObject();
            System.out.println("Mensaje del SERVIDOR:  " + mensaje_del_servidor);

            // Cerramos los recursos del socket cliente:
            flujo_de_entrada.close();
            flujo_de_salida.close();
            Thread.sleep(100);
        }
    }
}