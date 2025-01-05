package modele;

import java.sql.Connection;
import java.sql.SQLException;
import java.util.ArrayList;
import javax.swing.SwingUtilities;

import config.BD;
import vue.Fenetre;

public class ThreadUpdate extends Thread {

    private ListePizzas liste;
    private Fenetre fen;
    private volatile boolean running = true;

    public ThreadUpdate(ListePizzas liste, Fenetre fn) {
        this.liste = liste;
        fen = fn;
    }

    @Override
    public void run() {
        Connection co = BD.openConnection();

        while (running) {
            try {
                ArrayList<Pizza> newPizzas = BD.getAllPizzas(co);
                ListePizzas l = new ListePizzas(newPizzas);
                if (newPizzas.size() != fen.getListe().getListe().size()) {
                    fen.redessiner(l);
                }

            } catch (SQLException e) {
                e.printStackTrace();
            }

            try {
                Thread.sleep(5000);
            } catch (InterruptedException e) {
                e.printStackTrace();
            }
        }

        try {
            co.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
    }

    public void stopThread() {
        running = false;
        interrupt();
    }
}
