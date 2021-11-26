package ejercicio1;

import java.io.ObjectInputStream;
import java.io.ObjectOutputStream;
import java.net.ServerSocket;
import java.net.Socket;

public class Comunicacion extends Thread {

    private static int contador = 0;

    private int numero;

    private static ServerSocket servidor;

    private static Socket cliente;

    private boolean isALive = true;

    public Comunicacion(ServerSocket servidor) {
        this.servidor = servidor;
    }

    @Override
    public void run() {

        String mensajeCliente = "";

        try (Socket cliente = servidor.accept();
             ObjectInputStream ois = new ObjectInputStream(cliente.getInputStream());
             ObjectOutputStream oos = new ObjectOutputStream(cliente.getOutputStream())) {
//            Thread hilo = new Thread(){
//
//                public void run(){
//
//                    boolean isALive = true;
//
//                    try(ObjectOutputStream oos = new ObjectOutputStream(cliente.getOutputStream())){
//
//                        while (isALive){
//
//
//
//                        }
//
//                    }catch (Exception e){
//                        e.printStackTrace();
//                    }
//
//                }
//
//            };
            numero = ++contador;

            System.out.println("Conexion numero " + contador + " establecida");

            System.out.println("Informacion proporcionada por el cliente: ");

            System.out.println((String) ois.readObject());

            System.out.println("Iniciando servicio de mensajeria con el cliente");

            mensajeCliente = (String) ois.readObject();

            while (isALive) {

                if (mensajeCliente.equalsIgnoreCase("exit")) {
                    isALive = false;
                } else {
                    System.out.println("Cliente " + numero + ": " + mensajeCliente);
                    oos.writeObject(mensajeCliente);
                }
                mensajeCliente = (String) ois.readObject();

            }
        } catch (Exception e) {
            System.out.println("Comunicacion cerrada con el cliente " + numero + ".");
        }

    }
}
