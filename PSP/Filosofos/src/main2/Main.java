package main2;

import java.util.concurrent.locks.Lock;
import java.util.concurrent.locks.ReentrantLock;

public class Main {

    public static void main(String[] args) throws InterruptedException {

        Persona[] personas = new Persona[8];

        String[] nombres = new String[]{"1","2","3","4","5","6","7","8"};


        for (int i = 0; i < personas.length; i++) {

            personas[i] = new Persona(nombres[i]);

        }

        for (int i = 0; i < personas.length; i++) {
            personas[i].setPersonaDerecha(personas[(i + 1) % personas.length]);
            personas[i].setPersonaIzq(personas[i-1]);
        }

        Thread[] hilos = new Thread[8];

        for (int i = 0; i < personas.length; i++) {

            hilos[i] = new Thread(personas[i]);

        }

        hilos[0].start();
        hilos[1].start();
        hilos[2].start();
        hilos[3].start();
        hilos[4].start();
        hilos[5].start();
        hilos[6].start();
        hilos[7].start();
    }

}
