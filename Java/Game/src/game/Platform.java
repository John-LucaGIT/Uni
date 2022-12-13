package game;

import city.cs.engine.BoxShape;
import city.cs.engine.Shape;
import city.cs.engine.StaticBody;
import org.jbox2d.common.Vec2;

import java.util.ArrayList;

public class Platform{
    private static ArrayList<Platform> platforms = new ArrayList<Platform>();
    private static GameWorld level;
    private static float y = 7.5f;
    private Shape shape;
    private StaticBody body;

    public Shape getShape(){
        return shape;
    }
    public StaticBody getBody(){
        return body;
    }

    public Platform(Shape shape, StaticBody body) {
        this.shape = shape;
        this.body = body;
    }
    public static int randomNumber(){
        int upperbound = 5;
        int lowerbound = -5;
        float lastplatform = platforms.get(platforms.size() -1).body.getPosition().x;

        int random_int = (int)(Math.random() * (upperbound - lowerbound +1) + lowerbound);
        if (lastplatform - random_int <= 3 && lastplatform - random_int >= -3){
            System.out.println("Looking for new number");
            return randomNumber();
        }
        return random_int;
    }
    /** For the levels I have created a new class to create platforms more easily,
     * As I wanted to create a level that the player can not pass I have a minigame similar to
     * doodle jump where the character can try to reach a certain height. By creating this class
     * I have combined StaticBody and Shape parameters into one method where I can set the height and width
     * of a shape as well as set the position. To save the added platforms and keep track I have created an
     * array which stores the newly added platforms. New platforms are created in combination with the Tracker
     * class, once the character reaches one platform another is created. The creation of platforms occurs
     * with another ranomnumber method, this one however insures that if the last platforms x coordinates are
     * too similar to the next generated x coordinates the generator is called again creating a recursion.
     * In the future I would also add the changing platforms to the method by creating an ID for the platforms.
     * **/

    // method to add platforms with given parameters for height width and position
    public static void newPlatform(int halfWidth,float halfHeight,Vec2 platformPosition){
        if(level != null){ // if the level is not null
            // create a new box shape with parameters to be given
            Shape platformShape = new BoxShape(halfWidth, halfHeight);
            // create new static body for platform with level to be given
            StaticBody platform = new StaticBody(level, platformShape);
            // add platform to array
            Platform p = new Platform(platformShape,platform);
            platforms.add(p);
            // set platform position
            platform.setPosition(platformPosition);
        }
    }
    public static void startCreatePlatform(GameWorld l){
        level = l;
        platforms.clear();
        if (Game.getLevel() == 1){
            newPlatform(20,0.2f,new Vec2(0, -11.5f)); // ground platform
            newPlatform(4,0.5f,new Vec2(-9,5.5f)); // platform 1
            newPlatform(3,0.35f,new Vec2(8,0)); // platform 2
            newPlatform(3,0.35f,new Vec2(-5,-3)); // platform 3
            newPlatform(3,0.35f,new Vec2(3,-8)); // platform 4
            newPlatform(1,0.35f,new Vec2(-3,4)); // platform 5
        }
        else if (Game.getLevel() == 2){
            // list of platforms for level 2

            newPlatform(20,0.2f,new Vec2(0, -11.5f)); // ground platform
            newPlatform(4,0.5f,new Vec2(-15,4.5f)); // platform 1
            newPlatform(2,0.4f,new Vec2(4,-10)); // platform 2
            newPlatform(2,0.4f,new Vec2(-10,0)); // platform 4
        }
        else if(Game.getLevel() == 3){
            // list of platforms for level 3
            newPlatform(20,0.2f,new Vec2(0, -11.5f)); // ground platform
            newPlatform(4,0.5f,new Vec2(-15,4.5f)); // platform 1
            newPlatform(4,0.5f,new Vec2(-7,2.5f)); // platform 3
        }
        else if(Game.getLevel() == 4){
            // list of platforms for level 4
            newPlatform(20,0.2f,new Vec2(0, -11.5f)); // ground platform
            newPlatform(2,0.4f,new Vec2(8,-5)); // platform 1
            newPlatform(2,0.4f,new Vec2(-2,-2.5f)); // platform 2
            newPlatform(1,0.4f,new Vec2(-7.5f,2.5f)); // platform 3
            newPlatform(1,0.4f,new Vec2(-3.5f,7.5f)); // platform 4
        }

    }

    public static void addPlatform(float playerY){ // method to add new changing platforms when called in tracker
        if(playerY >= y){
            y+= 5;
            newPlatform(1,0.4f,new Vec2(randomNumber(),y));
        }
    }
}
