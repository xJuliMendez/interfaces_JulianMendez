package Filosofos;

/* Mirar https://www.baeldung.com/java-dining-philoshophers  */

import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

public class FilósofosPensantes {

    public static void main(String[] args) throws Exception {

        // Los strings siempre compararlos con String.equals(), ya que son punteros (objetos) no tipos primitivos (no usar "==")
        final boolean correcto = args.length > 0 && args[0].equals("correcto");

        if (correcto) buenaImplementación();
        else malaImplementación();
    }

    // ¡Atención!: los métodos estáticos solo pueden llamar a métodos estáticos (como es lógico)
    private static void malaImplementación() {
        Filósofo[] filósofos = new Filósofo[5];
        Lock[] tenedores = new Lock[filósofos.length];

        for (int i = 0; i < tenedores.length; i++) {
            tenedores[i] = new ReentrantLock();
        }

        for (int i = 0; i < filósofos.length; i++) {
            Object tenedorIzquierdo = tenedores[i];
            Object tenedorDerecho = tenedores[(i + 1) % tenedores.length];

            // Todos los filósofos son diestros y cogen primero el tenedor derecho:
            filósofos[i] = new Filósofo(tenedorDerecho, tenedorIzquierdo);

            Thread t = new Thread(filósofos[i], "Filósofo " + (i + 1));
            t.start();
        }
    }

    private static void buenaImplementación() {
        final Filósofo[] filósofos = new Filósofo[5];
        Object[] tenedores = new Object[filósofos.length];

        for (int i = 0; i < tenedores.length; i++) {
            tenedores[i] = new Object();
        }

        for (int i = 0; i < filósofos.length; i++) {
            Object tenedorIzquierdo = tenedores[i];
            Object tenedorDerecho = tenedores[(i + 1) % tenedores.length];

			// Añadir código solución aquí

            Thread t = new Thread(filósofos[i], "Filósofo " + (i + 1));
            t.start();
        }
    }
}
