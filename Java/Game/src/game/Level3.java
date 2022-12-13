package game;

import city.cs.engine.BoxShape;
import city.cs.engine.StaticBody;
import org.jbox2d.common.Vec2;

import javax.swing.*;
import java.awt.*;

public class Level3 extends GameWorld{
    private static Mike mike;
    private static Wizzard wizzard;
    private static boolean firstDeath = false;

    public Level3(Game game){
        super(game);
        //set position of shrek
        getPlayer().setPosition(new Vec2(8, -10));
        // add platforms
        Platform.startCreatePlatform(this);
        // Platform 2 stays as it changes
        Shape platform2Shape = new BoxShape(2,0.4f);
        platform2 = new StaticBody(this,platform2Shape);
        platform2.setPosition(new Vec2(2,-5));
        // Characters
        // Create Mike
        mike = new Mike(this);
        // set pos of Mike
        mike.setPosition(new Vec2(-15,5));
        // add collisiion listener for mike
        mike.addCollisionListener(new PickupDonkeys(getPlayer()));
        // Create Wizzard
        wizzard = new Wizzard(this);
        // set pos of Wizzard
        wizzard.setPosition(new Vec2(-7,5.5f));
        // add collision listener for wizzard
        wizzard.addCollisionListener(new PickupDonkeys(getPlayer()));
        // add death listeners
        mike.addDestructionListener(new deathListener(null,mike,this,game));
        wizzard.addDestructionListener(new deathListener(wizzard,null,this,game));
    }
    // initialize platform2
    private static StaticBody platform2;
    // getter for platform2
    public static StaticBody getPlatform2() {
        return platform2;
    }
    // getter for mike
    public static Mike getMike() {
        return mike;
    }
    // getter for wizzard
    public static Wizzard getWizzard() {
        return wizzard;
    }
    // getter for first death
    public static boolean isFirstDeath() {
        return firstDeath;
    }
    // setter for first death
    public static void setFirstDeath(boolean firstDeath) {
        Level3.firstDeath = firstDeath;
    }

    @Override
    public Image paintBackground(){
        Image background = new ImageIcon("data/swamp2.jpg").getImage();
        return background;
    }
    @Override
    public boolean isComplete() {
        if (getPlayer().getDonkeyCount() == 5)
            return true;
        else
            return false;
    }
    @Override
    public String getGameWorldName() {
        return "Level 3";
    }
}
