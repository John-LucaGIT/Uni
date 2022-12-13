package game;

import city.cs.engine.Walker;
import org.jbox2d.common.Vec2;

import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;
import java.awt.event.KeyListener;


public class Listener extends KeyAdapter implements KeyListener {
    // implement fields
    private static final float WALKING_SPEED = 4; // set walking speed
    private static final float JUMPING_SPEED = 15;  // allowed char to jump higher for demo purposes
    private static Vec2 position = (new Vec2(2,5)); // set position of platform
    private final Game world;
    private Vec2 position2 = (new Vec2(2,5)); // set pos of platform 2
    private Walker body;
    private static Vec2 posSaved;
    // create constructor for listener
    public Listener(Walker body, Game world){
        this.body = body;
        this.world = world;
    }
    // random int selector
    int randomWithRange(int min,int max){
        int range = (max - min) +1;
        return (int)(Math.random()*range)+min;
    }
    // key pressed method
    @Override
    public void keyPressed(KeyEvent e){
        if (Buttons.isControlsOn() == true){
            int code = e.getKeyCode(); // gets the key that was pressed
            if (code == KeyEvent.VK_F4){ // f4 == quit game
                System.exit(0);
            }
            else if (code == KeyEvent.VK_SPACE){ // space bar == jump
                Vec2 v = body.getLinearVelocity();
                if (Math.abs(v.y) < 0.01f){ // jump only if the body is not already jumping
                    body.jump(JUMPING_SPEED);
                    // add jump sound
                    try{
                        Sounds.getJumpSound().play();
                        posSaved = body.getPosition();
                    }catch (NullPointerException nullPointerException){ // if file not found continue without sound and print error message
                        System.out.println("Jump sound not found continuing without jump sound");
                    }

                }
            }
            else if (code == KeyEvent.VK_A){ // A == move left
                body.startWalking(-WALKING_SPEED);
                // flip image if it is horizontal
                if(body.getImages().get(0).isFlippedHorizontal() == true) {
                    body.getImages().get(0).flipHorizontal();
                }
                position = body.getPosition();
            }
            else if (code == KeyEvent.VK_D) { // D == move right
                body.startWalking(WALKING_SPEED);
                // flip the image if it is not horizontal
                if(body.getImages().get(0).isFlippedHorizontal() == false) {
                    body.getImages().get(0).flipHorizontal();
                }
                position2 = body.getPosition();
                // change platform 3 position based on players position and randomness
                if (Game.getLevel() == 2){
                    Level2.getPlatform3().setPosition(new Vec2(randomWithRange(-5,5)+position.x+position2.x,-5));
                }
                else if (Game.getLevel() == 3){
                    Level3.getPlatform2().setPosition(new Vec2(randomWithRange(-7,7)+position.x,-5));
                }
            }
            else if (code == KeyEvent.VK_S) { // S == Fall faster
                world.setGravity(Game.getWorld(),100.5f);
            }
        }
    }
    /**Using a randomint method through implementation of math.random I have created a number picker from a given range of values
     The method is called when the character moves to the right and then calls a platform created in Level 2 and changes the position
     using the random number method.
     **/


    public static Vec2 getPosition() {
        return position;
    }

    public Vec2 getPosition2() {
        return position2;
    }
    // key released method
    @Override
    public void keyReleased(KeyEvent e){
        int code = e.getKeyCode();
        if (code == KeyEvent.VK_A){ // stop walking if the key is released
            body.stopWalking();
        }
        else if (code == KeyEvent.VK_D){ // stop walking if the key is released
            body.stopWalking();
        }
        else if (code == KeyEvent.VK_S) { // stop falling faster if the key is released
            world.setGravity(Game.getWorld(),9.8f);
        }
    }
    // accessor to update controls when level is changed
    public void updateWalker(Walker body){
        this.body = body;
    }
    // getter for pos saved
    public static Vec2 getPosSaved() {
        return posSaved;
    }
}
