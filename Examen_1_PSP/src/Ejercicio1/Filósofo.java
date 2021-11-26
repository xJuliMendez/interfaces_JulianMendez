package Ejercicio1;

import java.io.IOException;
import java.io.ObjectOutputStream;
import java.net.Socket;
import java.util.concurrent.locks.Lock;

public class Filósofo implements Runnable {

    // Los tenedores a la izquierda y derecha de este filósofo:
    private Lock[] primerLock;
    private Lock[] segundoLock;
    private int entradas = 0;

    public Filósofo(Lock[] primerLock, Lock[] segundoLock) {
        this.primerLock = primerLock;
        this.segundoLock = segundoLock;
    }

    @Override
    public void run() {

        Lock lock1, lock2 = null;

        try {
            hacer("Voy a pensar un rato");


            while (true) {

                if (entradas <= 20) {

                    System.out.println(Thread.currentThread().getName() + " Me he cansado de pensar voy a ver si puedo sacar entradas.");
                    lock1 = seleccionarAleatorio(primerLock);
                    if (lock1.tryLock()) {
                        try {
                            hacer("Cojo el primer dispositivo.");

                            lock2 = seleccionarAleatorio(segundoLock);
                            if (lock2.tryLock()) {
                                try {
                                    // Comiendo
                                    hacer("Cojo el segundo dispositivo y me pongo a comprar entradas");

                                    try (Socket socket_cliente = new Socket("localhost", 9000);
                                         ObjectOutputStream oos = new ObjectOutputStream(socket_cliente.getOutputStream());) {
                                        System.out.println("comprando");
                                        for (int i = 0; i < 10; i++) {
                                            oos.writeObject("Compro una entrada");
                                            System.out.println(Thread.currentThread().getName() + " He comprado 10 entradas");
                                            Thread.sleep(((int) (100 + Math.random() * 3000)));
                                        }
                                        oos.writeObject("Muchas gracias, me voy");
                                        entradas += 10;
                                    } catch (IOException e) {
                                        e.printStackTrace();
                                    } catch (Exception e) {

                                    }

                                } finally {
                                    lock2.unlock();
                                }
                            } else {
                                hacer("No he podido coger el segundo dispositivo me pongo a pensar y suelto el primero");
                            }
                        } finally {
                            lock1.unlock();
                        }
                    } else {
                        hacer("No he podido coger el primer dispositivo suelto el primero y me pongo a pensar");
                    }

                } else {
                    hacer("Ya he comprado mis entradas, me voy al teatro.");
                    break;
                }

            }
        } catch (
                InterruptedException e) {
            Thread.currentThread().interrupt();
            return;
        }

    }

    private void hacer(String acción) throws InterruptedException {
        System.out.println(Thread.currentThread().getName() + " " + acción);
        Thread.sleep(((int) (100 + Math.random() * 3000)));
    }

    private Lock seleccionarAleatorio(Lock[] locks) {
        return locks[(int) (Math.floor(Math.random() * 3))];

    }

}