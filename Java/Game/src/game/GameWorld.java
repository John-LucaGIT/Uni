package game;

import city.cs.engine.*;
import org.jbox2d.common.Vec2;

import java.awt.*;

public abstract class GameWorld extends World {
    private Shrek shrek;
    private static Donkey donkey;
    private Tracker tracker;
    private GameView view;

    public GameWorld(Game game) {
        super();
        // Characters
        // create main char Shrek and Wizzard
        shrek = new Shrek(this);
        // initialize shrek position with no value as pos it set in levels
        shrek.setPosition(new Vec2());
        // Spawn donkeys for all levels
        for (int i = 0; i < 11; i++){
            donkey = new Pickup(this,"spawn");
            // set position of the donkeys
            donkey.setPosition(new Vec2(i*3-10,10));
            // add collision listener for the spawned donkeys
            donkey.addCollisionListener(new PickupDonkeys(shrek));
        }
    }
   
    // accessor for donkey
    public static Donkey getDonkey(){
        return donkey;
    }
    // accessor for player
    public Shrek getPlayer(){
        return shrek;
    }
    // Is the level complete
    public abstract boolean isComplete();
    // paint background method
    public abstract Image paintBackground();
    // getter for gameworld name
    public abstract String getGameWorldName();
    // method to add the tracker
    public void addTracker(GameView view){
        this.view = view;
        tracker = new Tracker(view,getPlayer());
        addStepListener(tracker);
    }
    // method to remove the tracker
    public void removeTracker(){
        if (tracker != null){
            removeStepListener(tracker);
        }
    }
    public boolean updateTracker(){ // method to update the tracker
        if(view != null){
            removeTracker();
            addTracker(view);
            return true;
        }
        return false;
    }
}

