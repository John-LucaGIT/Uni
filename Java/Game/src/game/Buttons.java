package game;

import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.io.FileNotFoundException;
import java.io.IOException;

public class Buttons implements ActionListener {
    private static boolean controlsOn = true;
    private GameWorld world;
    private Game game;
    private boolean sfxMuted;

    /**
     * Nothing particularly complex is in this class, most of my methods are using a graphical user interface as I prefer this over using keys.
     * One thing to note is that I used try catch everywhere I could to enable the player to continue playing the game even if some non essential files are
     * missing. There is a rather unnecessarily complex way of starting and stopping music, in the future I would create a seperate class and method for this
     * to allow for cleaner code and better oversight.
     **/



    // listener for buttons
    public void actionPerformed(ActionEvent e) {
        // gets the current game world
        world = Game.getWorld();

        // exists game if Quit button is pressed
        if (e.getActionCommand() == "Quit"){
            if(Game.getLevel() == 4){ // if player is in level 4 save score
                try {
                    SaveGame.highscore(Game.getWorld(),"data/highscore.txt");
                } catch (IOException ioException) { // incase of IO exception print stack trace
                    ioException.printStackTrace();
                }
            }
            System.exit(0);
        }
        else if (e.getActionCommand() == "Pause / Resume"){
            // calls pause method in game if pause button is pressed
            game.pause();
        }
        else if (e.getActionCommand() == "Restart"){
            // if restart button is pressed game will load restart file
            try {
                GameWorld world = SaveGame.load(game,"data/reset.txt");
                game.setLevel(world);
                // call update tracker
                world.updateTracker();
                if(Game.isplaying() == "finalmusic"){ // if final level music is playing it will be stopped and correct background music will play
                    try{
                        Sounds.getGravityFallsMusic().stop();
                        Sounds.getBackgroundMusic().play();
                        Sounds.getBackgroundMusic().loop();
                        Game.setplaying("backgroundmusic");
                    }catch (NullPointerException nullPointerException){ // if background.mp3 not found print error message and continue without sound
                        System.out.println("Error loading background music continuing without sound");
                    }
                }
            } catch (FileNotFoundException fileNotFoundException){ // if file is not found output could not find file
                System.out.println("Could not find restart file");
            } catch (IOException ioException) { // in case of IO exception print stacktrace
                ioException.printStackTrace();
            }
        }
        else if (e.getActionCommand() == "Mute"){ // Mute button switch using String to determine what music is being played and mute or unmute it
            if (Game.isplaying() == "backgroundmusic"){
                try{
                    Sounds.getBackgroundMusic().stop();
                    Game.setplaying("backgroundmusic off");
                }
                catch (NullPointerException nullPointerException){ // if file not found continue without music
                    System.out.println("File not found continuing without music");
                }
            }
            else if(Game.isplaying() == "backgroundmusic off"){
                try{
                    Sounds.getBackgroundMusic().play();
                    Game.setplaying("backgroundmusic");
                }
                catch (NullPointerException nullPointerException){ // if file not found continue without music
                    System.out.println("File not found continuing without music");
                }

            }
            else if(Game.isplaying() == "finalmusic"){
                try{
                    Sounds.getGravityFallsMusic().stop();
                    Game.setplaying("finalmusic off");
                }catch (NullPointerException nullPointerException){ // if file not found continue without music
                    System.out.println("File not found continuing without music");
                }
            }
            else if(Game.isplaying() == "finalmusic off"){
                try{
                    Sounds.getGravityFallsMusic().play();
                    Game.setplaying("finalmusic");
                }
                catch (NullPointerException nullPointerException){  // if file not found continue without music
                    System.out.println("File not found continuing without music");
                }
            }
        }
        else if (e.getActionCommand() == "Save"){ // Save button to call save method in SaveGame and write file to data/save.txt
            try {
                SaveGame.save(Game.getWorld(),"data/save.txt");
            } catch (IOException ioException) { // incase of IO exception print stack trace
                ioException.printStackTrace();
            }
        }
        else if (e.getActionCommand() == "Load"){ // load method from SaveGame called to load file from data/save.txt
            try {
                GameWorld world = SaveGame.load(game,"data/save.txt");
                game.setLevel(world);

            } catch (FileNotFoundException fileNotFoundException){
                System.out.println("File not found"); // if file is not found println file not found
            } catch (IOException ioException) {
                ioException.printStackTrace(); // print stacktrace for io exceptions
            }
        }
        else if (e.getActionCommand() == "Mute SFX"){ // If button is mute SFX then mute sounds with try catch incase sound not found
            try{
                if(sfxMuted != true){
                    Sounds.getGunshot().close();
                    Sounds.getCollectSound().close();
                    Sounds.getRoarSound().close();
                    Sounds.getJumpSound().close();
                    sfxMuted = true;
                }
            }catch (Exception ex){
                System.out.println("Files not found");
            }
        }
    }
    // constructor for buttons
    public Buttons(Game game) {
        this.game = game;
    }
    // accessor for controls boolean
    public static boolean isControlsOn(){
        return controlsOn;
    }

}
