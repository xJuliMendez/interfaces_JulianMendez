package main;

import java.util.concurrent.TimeUnit;
import java.util.concurrent.locks.Lock;

public class Filósofo implements Runnable {

    // Los tenedores a la izquierda y derecha de este filósofo:

    private Lock primerTenedor;
    private Lock segundoTenedor;

    public Filósofo(Lock primerTenedor, Lock segundoTenedor) {
        this.primerTenedor = primerTenedor;
        this.segundoTenedor = segundoTenedor;
    }

    @Override
    public void run() {
        try {
            while (true) {

                // Pensando
                hacer(" (en el instante " + System.nanoTime() + "):  Estoy pensando...");

                synchronized (primerTenedor) {
                    hacer(" (en el instante " + System.nanoTime() + "):  Cojo el primer tenedor.");

                    synchronized (segundoTenedor) {
                        // Comiendo
                        hacer(" (en el instante " + System.nanoTime() + "):  Cojo el segundo tenedor, y ahora... ¡me pongo a COMER! :^D");

                        hacer(" (en el instante " + System.nanoTime() + "):  Suelto el segundo tenedor.");
                    }

                    // De nuevo a pensar
                    hacer(" (en el instante " + System.nanoTime() + "):  Suelto el primer tenedor, y ahora... ¡me pongo a PENSAR! 8^?");
                }

            }
        } catch (InterruptedException e) {
            Thread.currentThread().interrupt();
            return;
        }
    }

    private void hacer(String acción) throws InterruptedException {
        System.out.println( Thread.currentThread().getName() + " " + acción);
        Thread.sleep(((int) (100 + Math.random() * 1000)));
    }
}