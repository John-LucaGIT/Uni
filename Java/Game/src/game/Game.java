package game;

import city.cs.engine.*;

import javax.swing.*;
import java.awt.*;
import java.io.FileNotFoundException;
import java.io.IOException;

/**
 * A world with some bodies.
 */
public class Game {
    /** The World in which the bodies move and interact. */
    private static GameWorld world;
    /** A graphical display of the world (a specialised JPanel). */
    private GameView view;
    /** Listener for keyActions */
    private Listener listener;
    /** Initialize level to type int */
    private static int level;
    // boolean for background music
    private static String playing;
    // getter for playing
    public static String isplaying() {
        return playing;
    }
    // setter for playing
    public static void setplaying(String playing) {
        Game.playing = playing;
    }
    // new game
    public Game() {
        // initialize world to level 1
        level = 1;
        world = new Level1(this);
        System.out.println(world);
        // set the window size
        view = new GameView(world, 1500, 900);
        // implement tracker
        world.addTracker(view);
        // set zoom of the view
        view.setZoom(40);
        // set Background of the world
        view.setBackground(world.paintBackground());
        // add the view to a frame (Java top level window)
        final JFrame frame = new JFrame("Protect Shrek's Swamp");
        frame.add(view);
        // implement control panel
        ControlPanel controlPanel = new ControlPanel(this);
        frame.add(controlPanel.getMainPanel(),BorderLayout.SOUTH);
        // load highscore
        try {
            SaveGame.loadscore(this,"data/highscore.txt");
        } catch (FileNotFoundException fileNotFoundException){
            System.out.println("File not found"); // if file is not found println file not found
        } catch (IOException ioException) {
            ioException.printStackTrace(); // print stacktrace for io exceptions
        }
        // enable the frame to quit the application
        // when the x button is pressed
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        frame.setLocationByPlatform(true);
        // don't let the frame be resized
        frame.setResizable(false);
        // size the frame to fit the world view
        frame.pack();
        //make the frame visible
        frame.setVisible(true);
        frame.requestFocus();
        // gives the keyboard focus to the frame if mouse is in view
        view.setFocusable(true);
        view.addMouseListener(new GiveFocus(view));
        // implement key listener
        listener = new Listener(world.getPlayer(),this);
        view.addKeyListener(listener);
        // mouse listener
        view.addMouseListener(new MouseHandler(view,this));
        // debug view
        JFrame debugView = new DebugViewer(world, 500, 500);
        // start world
        world.start();
        // if Levels 1-3 then play background music
        if (world instanceof Level1 || world instanceof Level2 || world instanceof Level3 ){
            try{
                Sounds.getBackgroundMusic().play();
                Sounds.getBackgroundMusic().loop();
                playing = "backgroundmusic";
            }catch (NullPointerException nullPointerException){  // if nullpointer and file not found continue without sound and print error msg
                System.out.println("Background music file not found, continuing without sound");
            }
        } // else if the level is 4 (final level then play final level music)
        else{
            Sounds.getGravityFallsMusic().play();
            Sounds.getGravityFallsMusic().loop();
            playing = "finalmusic";
        }
    }

    // accessor for the current world
    public static GameWorld getWorld() {
        return world;
    }
    // getter for GameView
    public GameView getView() {
        return view;
    }
    // getter for Listener
    public Listener getListener() {
        return listener;
    }
    // change Gravity
    public void setGravity(GameWorld world,Float g){
        world.setGravity(g);
    }
    // setLevel
    public void setLevel(GameWorld world){
            //stop the current level
            this.world.stop();
            //create the new (appropriate) level
            //level now refers to new level
            this.world = world;
            this.view.setBackground(world.paintBackground());
            //change the view to look into new level
            view.updateWorld(this.world);
            view.setWorld(this.world);
            view.setZoom(40);
            // update tracker
            if(!world.updateTracker()){
                world.addTracker(view);
            }
            // load highscore
            try {
                SaveGame.loadscore(this,"data/highscore.txt");
            } catch (FileNotFoundException fileNotFoundException){
                System.out.println("File not found"); // if file is not found println file not found
            } catch (IOException ioException) {
                ioException.printStackTrace(); // print stacktrace for io exceptions
            }
            // update controls
            listener.updateWalker(world.getPlayer());
            //start the simulation in the new level
            this.world.start();
        }
    // accessor for the current level number
    public static int getLevel(){
        return level;
    }
    // setter for level number
    public static void setLevelInt(int level) {
        Game.level = level;
    }

    public void goToNextLevel(){
        if (world instanceof Level1){
            //stop the current level
            world.stop();
            level = 2;
            //create the new (appropriate) level
            //level now refers to new level
            world = new Level2(this);
            view.setBackground(world.paintBackground());
            //change the view to look into new level
            view.updateWorld(this.world);
            view.setWorld(world);
            view.setZoom(40);
            // update tracker
            if(!world.updateTracker()){
                world.addTracker(view);
            }
            // update controls
            listener.updateWalker(world.getPlayer());
            //start the simulation in the new level
            world.start();
        }
        else if (world instanceof Level2){
            // stop level
            world.stop();
            // set level int to level 3
            level = 3;
            // set level to level 3
            world = new Level3(this);
            // set background for level 3
            view.setBackground(world.paintBackground());
            // set view  and zoom for level 3
            view.updateWorld(this.world);
            view.setWorld(world);
            view.setZoom(40);
            // update tracker
            if(!world.updateTracker()){
                world.addTracker(view);
            }
            // update controls
            listener.updateWalker(world.getPlayer());
            // start world
            world.start();
        }
        else if (world instanceof Level3){
            // stop music
            try{
                Sounds.getBackgroundMusic().stop();
                Sounds.getGravityFallsMusic().play();
                Sounds.getGravityFallsMusic().loop();
                playing = "finalmusic";
            }catch (NullPointerException nullPointerException){ // if file not found continue without sound and print error message
                System.out.println("Sound files not found continuing without sound");
            }
            // set int to level 4
            level = 4;
            // stop level
            world.stop();
            // start level 4
            world = new Level4(this);
            // load highscore
            try {
                SaveGame.loadscore(this,"data/highscore.txt");
            } catch (FileNotFoundException fileNotFoundException){
                System.out.println("File not found"); // if file is not found println file not found
            } catch (IOException ioException) {
                ioException.printStackTrace(); // print stacktrace for io exceptions
            }
            // set background for level 4
            view.setBackground(world.paintBackground());
            // set view and zoom for level 4
            view.updateWorld(this.world);
            view.setWorld(world);
            view.setZoom(40);
            // update tracker
            if(!world.updateTracker()){
                world.addTracker(view);
            }
            // update controls
            listener.updateWalker(world.getPlayer());
            // start world
            world.start();
        }
        else if (world instanceof Level4){
            // if level 4 is completed game is completed
            System.out.println("Well done! Game complete.");
            System.exit(0);
        }
    }
    public void pause(){
        if (world.isRunning() == true){ // if the world is running stop the world
            world.stop();
        }
        else{
            world.start(); // if it is not running start the world
        }
    }

    /** Run game. */
    public static void main(String[] args) {
        new Game();
    }

}
