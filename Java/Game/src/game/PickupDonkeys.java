package game;

import city.cs.engine.CollisionEvent;
import city.cs.engine.CollisionListener;

public class PickupDonkeys implements CollisionListener {
    // create fields
    private Shrek shrek;
    private Wizzard wizzard;
    private Mike mike;
    // create constructors
    public PickupDonkeys(Shrek s){
        this.shrek = s;
    }
    public PickupDonkeys(Wizzard w){this.wizzard = w;}
    public PickupDonkeys(Mike m){this.mike = m;}

    /** In this class I have used the collision event provided by the engine to create several
     * uses for the character. Besides from a simple pickup method that allows the character to pickup
     * donkeys (weapon) to shoot at the enemey, there are also collision listeners that ensure if the donkey
     * is of type weapon and if it collides with the enemy a life is subtracted from the enemy. To do this I had to
     * create an additional class called Shooter which defines the donkey as a weapon whereas other types of donkey
     * are pickups (ammo).
     * **/

    @Override
    // collision event method
    public void collide(CollisionEvent e) {
        if (e.getOtherBody() == shrek && e.getReportingBody() instanceof Pickup) { // if body is shrek and reporting body is instance of pickup class for donkey object
            shrek.addDonkey(); // add a donkey to shrek
            try{
                Sounds.getCollectSound().setVolume(2.0);
                Sounds.getCollectSound().play();
            }catch(NullPointerException nullPointerException){ // if sound not found continue without sound and send error msg
                System.out.println("Pickup sound not found continuing without sound");
            }
            // destroy donkey object
            e.getReportingBody().destroy();
        }
        // if reporting body is wizzard and other body is shrek then remove life from shrek
        else if (e.getOtherBody() == shrek && e.getReportingBody() instanceof Wizzard){
            shrek.subLife();
            System.out.println("OOPS LOST LIFE...");
        }
        // if body is shrek and reporting body is mike then remove life from shrek
        else if (e.getOtherBody() == shrek && e.getReportingBody() instanceof  Mike){
            shrek.subLife();
            System.out.println("OOPS LOST LIFE...");
        }
        // if body is wizzard and reporting body is shooter (donkey that was shot) remove life from wizzard
        else if (e.getOtherBody() == wizzard && e.getReportingBody() instanceof Shooter){
            wizzard.lostLife();
        }
        // if body is mike and reporting body is shooter (donkey that was shot) remove life from mike
        else if (e.getOtherBody() == mike && e.getReportingBody() instanceof Shooter){
            mike.lostLife();
        }

    }
}