package game;

import city.cs.engine.*;

public class Wizzard extends Walker {
    // add collision to the shape
    private static final Shape wizzardShape = new PolygonShape(
            -1.5f,-2.24f, 0.99f,-2.22f, 1.52f,1.07f, 0.12f,2.3f, -1.49f,0.4f, -1.53f,-1.97f);
    // add image to the body
    private static final BodyImage image =
            new BodyImage("data/wizzard.png", 5f);

    private static int healthCount;
    // lost life method that subtracts a life if there are lives left
    public void lostLife(){
        if (healthCount >= 1) {
            healthCount--;
            System.out.println("Wizzards life: "+healthCount);
        }
        else if (healthCount == 0){
            destroy();
            System.out.println("You did it Donkey!");
        }
    }
    // getter for healthcount
    public static int getHealthCount() {
        return healthCount;
    }
    // setter for healthcount wizzard
    public static void setHealthCount(int healthCount) {
        Wizzard.healthCount = healthCount;
    }
    // constructor for wizzard
    public Wizzard(World world) {
        super(world, wizzardShape);
        addImage(image);
        healthCount = 1;
    }
}
