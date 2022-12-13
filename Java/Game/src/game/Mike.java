package game;

import city.cs.engine.*;

public class Mike extends Walker {
    // add collision to the shape
    private static final Shape mikeShape = new PolygonShape(
            -1.3f,-2.39f, 2.08f,-2.38f, 2.03f,2.39f, -0.07f,2.43f, -2.1f,0.81f, -1.41f,-2.06f);
    // add image to the body
    private static final BodyImage image =
            new BodyImage("data/Mike.png", 5f);

    private static int healthCount;
    // lost life method that subtracts a life if there are lives left
    public void lostLife(){
        if (healthCount >= 1) {
            healthCount--;
            System.out.println("Mikes life: "+healthCount);
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
    // setter for healthcount
    public static void setHealthCount(int healthCount) {
        Mike.healthCount = healthCount;
    }
    // constructor for mike
    public Mike(World world) {
        super(world, mikeShape);
        addImage(image);
        healthCount = 1;
    }
}
