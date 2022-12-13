package game;

import org.jbox2d.common.Vec2;

import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;

public class Level1 extends GameWorld implements ActionListener {
    private static Wizzard wizzard;

    public Level1(Game game){
        super(game);
        //set position of shrek
        getPlayer().setPosition(new Vec2(8, -10));
        // Add platforms
        Platform.startCreatePlatform(this);
        // Characters
        // Create new Wizzzard
        wizzard = new Wizzard(this);
        // Set position
        wizzard.setPosition(new Vec2(-7,8));
        // add destruction listener to trigger next level
        wizzard.addDestructionListener(new deathListener(wizzard,null,this,game));
        // add coll listener for health
        wizzard.addCollisionListener(new PickupDonkeys(getPlayer()));
    }
    public static Wizzard getWizzard(){return wizzard;}


    @Override
    // paintbackground method
    public Image paintBackground(){
        Image background = new ImageIcon("data/swamp.jpg").getImage();
        return background;
    }

    @Override
    // get gameworld method for SaveGame
    public String getGameWorldName() {
        return "Level 1";
    }

    @Override
    public boolean isComplete() {
        // if the wizzard has no more lives the level is completed
        if (Wizzard.getHealthCount() <= 0)
            return true;
        else
            return false;
    }
    @Override
    public void actionPerformed(ActionEvent e) {
    }
}
