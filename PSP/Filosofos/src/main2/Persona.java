package main2;

import java.util.concurrent.locks.Lock;

public class Persona implements Runnable{

    private String nombre;

    private Persona personaDerecha = null;
    private Persona personaIzq = null;

    private boolean haHabladoDerecha = false;
    private boolean haHabladoIzq = false;

    public Persona(String nombre){
        this.nombre = nombre;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public Persona getPersonaDerecha() {
        return personaDerecha;
    }

    public void setPersonaDerecha(Persona personaDerecha) {
        this.personaDerecha = personaDerecha;
    }

    public Persona getPersonaIzq() {
        return personaIzq;
    }

    public void setPersonaIzq(Persona personaIzq) {
        this.personaIzq = personaIzq;
    }

    public boolean isHaHabladoDerecha() {
        return haHabladoDerecha;
    }

    public void setHaHabladoDerecha(boolean haHabladoDerecha) {
        this.haHabladoDerecha = haHabladoDerecha;
    }

    public boolean isHaHabladoIzq() {
        return haHabladoIzq;
    }

    public void setHaHabladoIzq(boolean haHabladoIzq) {
        this.haHabladoIzq = haHabladoIzq;
    }

    @Override
    public synchronized void run() {

        Persona eleccion = elegirPersona();
        while (!haHabladoDerecha){

//            try {
//                Thread.sleep((long) Math.random()*1000);
//            } catch (InterruptedException e) {
//                e.printStackTrace();
//            }



            synchronized (eleccion){
                if (eleccion == personaDerecha && !haHabladoDerecha){
                    System.out.println(this.nombre + " está hablando con la persona de su deracha " + personaDerecha.getNombre());
                    personaDerecha.setHaHabladoIzq(true);
                    this.setHaHabladoDerecha(true);
                    eleccion = personaIzq;
                }else if(eleccion == personaIzq && !haHabladoIzq) {
                    System.out.println(this.nombre + " está hablando con la persona de su izquierda " + personaIzq.getNombre());
                    personaIzq.setHaHabladoDerecha(true);
                    this.setHaHabladoIzq(true);
                    eleccion = personaDerecha;
                }

                try {
                    Thread.sleep((long) Math.random()*5 + 1000);
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
            }
        }

    }

    private boolean haHabladoAmbos(){

        if (haHabladoDerecha && haHabladoIzq) return true;
        else return false;

    }

    private Persona elegirPersona(){

        if (Math.round(Math.random()) == 1){
            return personaIzq;
        }else {
            return personaDerecha;
        }

    }

}
