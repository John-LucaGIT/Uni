package game;

import city.cs.engine.StepEvent;
import city.cs.engine.StepListener;
import org.jbox2d.common.Vec2;

public class Tracker implements StepListener {
    // implement fields
    private GameView view;
    private Shrek shrek;
    private static int score;
    // constructor for tracker
    public Tracker(GameView view, Shrek shrek) {
        this.view = view;
        this.shrek = shrek;
    }
    public void preStep(StepEvent e) {
    }
    // actions performed afterStep
    public void postStep(StepEvent e) {
        if(Game.getLevel() == 4){
            // set view centre for character
            view.setCentre(new Vec2(shrek.getPosition().x-8,shrek.getPosition().y+6));
            // if the level is 4 call add platform method
            Platform.addPlatform(shrek.getPosition().y);
        }
        if(shrek.getPosition().y <= -10){
            shrek.shrekDie();
        }else if (Game.getLevel() < 4){ // if level is less than 4 and the position of shrek is out of the game field, then teleport shrek back into the game field
            if(shrek.getPosition().x <= -20){
                shrek.setPosition(new Vec2(20,-9));
            }
            else if(shrek.getPosition().x >= 20){
                shrek.setPosition(new Vec2(-20,-9));
            }
        }
        score = (int) Math.floor(shrek.getPosition().y+9); // update score field with shreks y position

    }
    // getter for score
    public static int getScore() {
        return score;
    }
}


