package game;

import city.cs.engine.UserView;

import java.awt.*;

public class GameView extends UserView {
    public Image background;
    public float y;
    private GameWorld w;
    public void updateWorld(GameWorld w){
        this.w = w;
    }
    public GameView(GameWorld w, int width, int height) {
        super(w, width, height);
        y = w.getPlayer().getPosition().y;
        this.w = w;
    }
    // set background
    public void setBackground(Image background) {
        this.background = background;
    }


    @Override
    protected void paintBackground(Graphics2D g) {
        g.drawImage(background, 0, 0, this);
    }
    @Override
    protected void  paintForeground(Graphics2D g){
        // added visual information and changed font and font size for better visibility
        g.setFont(new Font("TimesRoman",Font.PLAIN,20));
        g.setColor(Color.white);
        // How many donkeys does char have
        g.drawString("Donkeys: "+Shrek.getDonkeyCount(),10,30);
        // how many lives does char have
        g.drawString("Your lives: "+Shrek.getHealthCount(),10,90);
        // what level is char on
        g.drawString("Current level: "+Game.getLevel(),1350,30);
        // enemy live information
        if (Game.getLevel() == 1){ // if level 1 show wizzard healthcount
            g.drawString("Enemies lives: "+Wizzard.getHealthCount(),10,60);
        }
        else if (Game.getLevel() == 2){ // if level 2 show mike healthcount
            g.drawString("Enemies lives: "+Mike.getHealthCount(),10,60);
        }
        else if (Game.getLevel() == 3){ // if level 3 then show information for wizzard and mike health
            g.drawString("Mikes lives: "+Mike.getHealthCount()+" Wizzards lives: "+Wizzard.getHealthCount(),10,60);
        }
        else if (Shrek.getHealthCount() == 0){ // if health is 0 draw gameover
            g.setFont(new Font("TimesRoman",Font.PLAIN,70));
            g.drawString("Game Over!",1500/3,900/2);
        }
        else if (Game.getLevel() == 4){ // if level 4 then draw score and high score fields
            g.drawString("Score: "+ Tracker.getScore(),10,60);
            g.drawString("High score: "+Shrek.getHighscore(),1350,60);
            float yNew = w.getPlayer().getPosition().y;
            if(y+1.2 > yNew){ // If the player jumps the messages will disappear as they only get in the way of the game experience
                g.drawString("Well done you defended the Swamp from the Wizzard and Mike Wazowski!",430,840);
                g.drawString("See what score you can reach", 560, 860);
            }
        }

    }
}


