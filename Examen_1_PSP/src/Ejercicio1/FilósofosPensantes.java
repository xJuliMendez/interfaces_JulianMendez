package Ejercicio1;

/* Mirar https://www.baeldung.com/java-dining-philoshophers  */

import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

public class FilósofosPensantes {

    public static void main(String[] args) throws Exception {

        // Los strings siempre compararlos con String.equals(), ya que son punteros (objetos) no tipos primitivos (no usar "==")

        Filósofo[] filósofos = new Filósofo[5];

        Lock[] ordenadores = new Lock[3];
        for (int i = 0; i < 3; i++) {
            ordenadores[i] = new ReentrantLock();
        }

        Lock[] teclados = new Lock[3];
        for (int i = 0; i < 3; i++) {
            teclados[i] = new ReentrantLock();
        }

        for (int i = 0; i < 5; i++) {
            if (i%2 == 2){
                filósofos[i] = new Filósofo(ordenadores, teclados);

                Thread t = new Thread(filósofos[i], "Filósofo " + (i + 1));
                t.start();
            }else{
                filósofos[i] = new Filósofo(teclados, ordenadores);

                Thread t = new Thread(filósofos[i], "Filósofo " + (i + 1));
                t.start();
            }
        }


    }

}
