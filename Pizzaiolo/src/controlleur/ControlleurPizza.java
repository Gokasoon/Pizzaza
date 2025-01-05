package controlleur;

import java.awt.Color;
import java.awt.Dimension;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.sql.SQLException;

import javax.swing.BorderFactory;
import javax.swing.JButton;
import javax.swing.JPanel;
import javax.swing.Timer;

import config.BD;
import modele.Pizza;
import vue.VueListePizzas;
import vue.VuePizza;

public class ControlleurPizza extends JPanel implements ActionListener {
    private Pizza modele;
    private VuePizza vuePizza;
    private JButton btnFini;
    private JButton btnAnnuler;
    private Timer removalTimer;
    private static final String ACTION_FINIR = "FINIR";
    private static final String ACTION_ANNULER = "ANNULER";
    private static final int DELAI = 1750; 

    public ControlleurPizza(VuePizza vue, Pizza modele) {
        this.modele = modele;
        vuePizza = vue;
        btnFini = new JButton("Pizza finie");
        btnAnnuler = new JButton("Annuler");
        
        btnFini.setPreferredSize(new Dimension(100, 100));
        btnFini.setForeground(Color.BLACK);
        btnFini.setBackground(Color.RED);

        btnFini.addActionListener(this);
        btnFini.setActionCommand(ACTION_FINIR);
        
        btnAnnuler.addActionListener(this);
        btnAnnuler.setActionCommand(ACTION_ANNULER);
        btnAnnuler.setEnabled(false);
        
        JPanel button = new JPanel();
        button.add(btnFini);
        button.add(btnAnnuler);
        
        add(button);
        vue.add(this);
    }

    public void actionPerformed(ActionEvent e) {
        if (e.getActionCommand().equals(ACTION_FINIR)) {
            vuePizza.setBackground(Color.GRAY);
            btnFini.setBackground(Color.GRAY);
            btnFini.setEnabled(false);
            btnAnnuler.setEnabled(true);
            vuePizza.pizzaFinie();

            removalTimer = new Timer(DELAI, new ActionListener() {
                public void actionPerformed(ActionEvent evt) {
                	retirerPizza();
					try {
						BD.setPizzaPrete(modele);
					} catch (SQLException e) {
						e.printStackTrace();
					}
                	
                	
                }
            });
            removalTimer.setRepeats(false);
            removalTimer.start();
        } else if (e.getActionCommand().equals(ACTION_ANNULER)) {
            if (removalTimer != null && removalTimer.isRunning()) {
                removalTimer.stop();
                btnAnnuler.setEnabled(false);
                vuePizza.setBackground(Color.WHITE);
                vuePizza.setBorder(BorderFactory.createMatteBorder(1, 1, 1, 1, Color.BLUE));
                btnFini.setForeground(Color.BLACK);
                btnFini.setBackground(Color.RED);
                btnFini.setEnabled(true);
            }
        }
    }

    private void retirerPizza() {
        VueListePizzas parentPanel = (VueListePizzas) vuePizza.getParent();
        parentPanel.remove(vuePizza);
        parentPanel.revalidate();
        parentPanel.repaint();
    }
}
