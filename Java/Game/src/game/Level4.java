package game;

import org.jbox2d.common.Vec2;

import javax.swing.*;
import java.awt.*;

public class Level4 extends GameWorld{
    private static Mike mike;
    private static Wizzard wizzard;
    private static boolean firstDeath = false;

    public Level4(Game game){
        super(game);
        //set position of shrek
        getPlayer().setPosition(new Vec2(8, -10));
        // call create platform method from Platform
        Platform.startCreatePlatform(this);
    }
    // method to paint new background
    @Override
    public Image paintBackground(){
        Image background = new ImageIcon("data/swamp3.jpg").getImage();
        return background;
    }
    // method to set game world name
    @Override
    public String getGameWorldName() {
        return "Level 4";
    }
    // method to determine if level is completed
    @Override
    public boolean isComplete() {
        if (getPlayer().getDonkeyCount() == 5)
            return true;
        else
            return false;
    }
}
