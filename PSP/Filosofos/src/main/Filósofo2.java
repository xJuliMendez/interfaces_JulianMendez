package main;

import java.util.concurrent.TimeUnit;
import java.util.concurrent.locks.Lock;

public class Filósofo2 implements Runnable {

    // Los tenedores a la izquierda y derecha de este filósofo:

    private Lock primerTenedor;
    private Lock segundoTenedor;

    public Filósofo2(Lock primerTenedor, Lock segundoTenedor) {
        this.primerTenedor = primerTenedor;
        this.segundoTenedor = segundoTenedor;
    }

    @Override
    public void run() {
        try {
            while (tryLockBothLocks()) {

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

    private boolean tryLockBothLocks() {
        String threadName = Thread.currentThread().getName();

        try {
            boolean lock1Succeeded = primerTenedor.tryLock(1000, TimeUnit.MILLISECONDS);
            if(!lock1Succeeded) {
                return false;
            }
        } catch (InterruptedException e) {
            System.out.println(threadName + " interrupted trying to lock Lock 1");
            return false;
        }
        try {
            boolean lock2Succeeded = segundoTenedor.tryLock(1000, TimeUnit.MILLISECONDS);
            if(!lock2Succeeded) {
                primerTenedor.unlock();
                return false;
            }
        } catch (InterruptedException e) {
            System.out.println(threadName + " interrupted trying to lock Lock 2");
            primerTenedor.unlock();
            return false;
        }
        return true;
    }

    private void hacer(String acción) throws InterruptedException {
        System.out.println( Thread.currentThread().getName() + " " + acción);
        Thread.sleep(((int) (100 + Math.random() * 1000)));
    }
}