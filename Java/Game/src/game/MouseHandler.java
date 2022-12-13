package game;

import org.jbox2d.common.Vec2;

import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;

public class MouseHandler extends MouseAdapter {
    private GameView view;
    private Game game;
    private Vec2 towards;
    private Vec2 p;

    public MouseHandler(GameView view,Game game) {
        this.view = view;
        this.game = game;
    }
    @Override
    public void mousePressed(MouseEvent e) {
        GameWorld world = game.getWorld();
        if (Buttons.isControlsOn() == true){
            if (Shrek.getDonkeyCount() >= 1){
                //create donkey
                Donkey donkey = new Shooter(world,"weapon");
                // set position to position of player
                donkey.setPosition(world.getPlayer().getPosition().add(new Vec2(-0.5f, 2.5f)));
                donkey.setGravityScale(1.5f);
                // setting linear velocity to make it look like donkey is being thrown
                donkey.setLinearVelocity(new Vec2(-50, -4));
                // add sound effect
                try{
                    Sounds.getGunshot().play();
                }catch (NullPointerException nullPointerException){
                    System.out.println("File not found shooting without sound"); // in case file is not found print file not found and continue without sound
                }
                // remove one donkey
                Shrek.removeDonkey();
                // implement collision listeners
                donkey.addCollisionListener(new PickupDonkeys(Level1.getWizzard()));
                donkey.addCollisionListener(new PickupDonkeys(Level2.getMike()));
                donkey.addCollisionListener(new PickupDonkeys(Level3.getMike()));
                donkey.addCollisionListener(new PickupDonkeys(Level3.getWizzard()));
            }
        }

    }

    @Override
    public void mouseClicked(MouseEvent e) {
    }
    @Override
    public void mouseReleased(MouseEvent e) {
    }
    @Override
    public void mouseEntered(MouseEvent e) {
    }
    @Override
    public void mouseExited(MouseEvent e) {
    }
}
  