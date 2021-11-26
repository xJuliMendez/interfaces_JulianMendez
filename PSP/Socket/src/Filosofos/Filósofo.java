package Filosofos;

import java.util.concurrent.locks.Lock;

public class Filósofo implements Runnable {

    // Los tenedores a la izquierda y derecha de este filósofo:
    private Lock primerTenedor;
    private Lock segundoTenedor;

    public Filósofo(Object primerTenedor, Object segundoTenedor) {
        this.primerTenedor = (Lock) primerTenedor;
        this.segundoTenedor = (Lock) segundoTenedor;
    }

    @Override
    public void run() {
        try {
            while (true) {

                // Pensando
                hacer(" (en el instante " + System.nanoTime() + "):  Estoy pensando...");

                if (primerTenedor.tryLock()){
                    hacer(" (en el instante " + System.nanoTime() + "):  Cojo el primer tenedor.");

                    if (segundoTenedor.tryLock()){
                        // Comiendo
                        hacer(" (en el instante " + System.nanoTime() + "):  Cojo el segundo tenedor, y ahora... ¡me pongo a COMER! :^D");

                        hacer(" (en el instante " + System.nanoTime() + "):  Suelto el segundo tenedor.");
                    }

                    // De nuevo a pensar
                    hacer(" (en el instante " + System.nanoTime() + "):  Suelto el primer tenedor, y ahora... ¡me pongo a PENSAR! 8^?");
                }else {
                    Thread.sleep(((int) (100 + Math.random() * 1000)));
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