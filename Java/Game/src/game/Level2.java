package game;

import city.cs.engine.BoxShape;
import city.cs.engine.StaticBody;
import org.jbox2d.common.Vec2;

import javax.swing.*;
import java.awt.*;

public class Level2 extends GameWorld{
    private static Mike mike;

    public Level2(Game game){
        super(game);
        // create platforms
        Platform.startCreatePlatform(this);
        //set position of shrek
        getPlayer().setPosition(new Vec2(8, -10));
        // Platform 3 stays as it changes
        Shape platform3Shape = new BoxShape(2,0.4f);
        platform3 = new StaticBody(this,platform3Shape);
        platform3.setPosition(new Vec2(2,-5)); // initial position of platform 3
        // Character
        // Create Mike
        mike = new Mike(this);
        // set pos of Mike
        mike.setPosition(new Vec2(-15,5));
        // add collision listener for mike
        mike.addCollisionListener(new PickupDonkeys(getPlayer()));
        // add destruction listener to determine if level is completed
        mike.addDestructionListener(new deathListener(null,mike,this,game));
    }
    // field for platform 3
    private static StaticBody platform3;
    // getter for platform 3
    public static StaticBody getPlatform3() {
        return platform3;
    }
    // getter for mike
    public static Mike getMike() {
        return mike;
    }

    @Override
    // paint background method
    public Image paintBackground(){
        Image background = new ImageIcon("data/swamp2.jpg").getImage();
        return background;
    }
    @Override
    // level completed method
    public boolean isComplete() {
        if (getPlayer().getDonkeyCount() == 5)
            return true;
        else
            return false;
    }
    @Override
    // savegame level method
    public String getGameWorldName() {
        return "Level 2";
    }

}
