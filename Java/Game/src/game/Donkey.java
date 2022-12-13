package game;
import city.cs.engine.*;

public class Donkey extends DynamicBody {
    // create a circle shape for the object Donkey
    private static final Shape donkeyShape = new CircleShape(1);
    // add image to the shape
    private static final BodyImage image = new BodyImage("data/donkey.png", 2f);

    public Donkey(World w, String t) {
        super(w,donkeyShape);
        addImage(image);
    }
}
