package game;

import javax.swing.*;

public class ControlPanel {
    private JPanel mainPanel;
    private JButton pauseButton;
    private JButton restartButton;
    private JButton quitButton;
    private JButton muteButton;
    private JButton saveButton;
    private JButton loadButton;
    private JButton muteSFXButton;

    public ControlPanel(Game game){
        quitButton.addActionListener(new Buttons(game));
        pauseButton.addActionListener(new Buttons(game));
        restartButton.addActionListener(new Buttons(game));
        muteButton.addActionListener(new Buttons(game));
        saveButton.addActionListener(new Buttons(game));
        loadButton.addActionListener(new Buttons(game));
        muteSFXButton.addActionListener(new Buttons(game));
    }


    public JPanel getMainPanel() {
        return mainPanel;
    }
}
