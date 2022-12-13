package game;

import city.cs.engine.DestructionEvent;
import city.cs.engine.DestructionListener;

public class deathListener implements DestructionListener {
    private GameWorld world;
    private Game game;
    private Wizzard wizzard;
    private Mike mike;
    public deathListener(Wizzard w, Mike m,GameWorld world, Game game) {
        this.wizzard = w;
        this.world = world;
        this.game = game;
        this.mike = m;
    }

    /** The deathlistener is my main method of calling for new levels,
     * for level 3 there is a boolean check that ensures both characters have died
     * before proceding to the final level.
     *  **/


    @Override
    // implement death listener to initialize next level when object is destroyed
    public void destroy(DestructionEvent d) {
        // if both get destroyed the game is completed
        if (Game.getLevel() <= 2 ){
            if(d.getSource() == wizzard){
                game.goToNextLevel();
            }
            else if (d.getSource() == mike){
                game.goToNextLevel();
            }
        }
        else if (Game.getLevel() == 3){
            if (d.getSource() == mike){
                if (Level3.isFirstDeath() == true){
                    game.goToNextLevel();
                }
                else{
                    Level3.setFirstDeath(true);
                }
            }
            else if(d.getSource() == wizzard){
                if (Level3.isFirstDeath() == true){
                    game.goToNextLevel();
                }
                else{
                    Level3.setFirstDeath(true);
                }
            }
        }
    }
}
