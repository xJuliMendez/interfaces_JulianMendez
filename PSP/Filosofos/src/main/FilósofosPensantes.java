package main;

/* Mirar https://www.baeldung.com/java-dining-philoshophers  */

import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

public class FilósofosPensantes {

    public static void main(String[] args) throws Exception {

        // Los strings siempre compararlos con String.equals(), ya que son punteros (objetos) no tipos primitivos (no usar "==")
        final boolean correcto = args.length > 0 && args[0].equals("correcto");

        buenaImplementación();
    }

    private static void buenaImplementación() throws InterruptedException {
        Filósofo[] filósofos = new Filósofo[5];
        Lock[] tenedores = new Lock[filósofos.length];

        for (int i = 0; i < tenedores.length; i++) {
            tenedores[i] = new ReentrantLock();
        }

        for (int i = 0; i < filósofos.length; i++) {
            Lock tenedorIzquierdo = tenedores[i];
            Lock tenedorDerecho = tenedores[(i + 1) % tenedores.length];

            // Todos los filósofos son diestros y cogen primero el tenedor derecho:
            filósofos[i] = new Filósofo(tenedorDerecho, tenedorIzquierdo);

            Thread t = new Thread(filósofos[i], "Filósofo " + (i + 1));
            t.start();
        }
    }
}
