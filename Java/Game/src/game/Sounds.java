package game;

import city.cs.engine.SoundClip;

import javax.sound.sampled.LineUnavailableException;
import javax.sound.sampled.UnsupportedAudioFileException;
import java.io.IOException;

public class Sounds {

    // initialize sounds
    private static SoundClip backgroundMusic;
    private static SoundClip gravityfallsMusic;
    private static SoundClip roarSound;
    private static SoundClip jumpSound;
    private static SoundClip collectSound;
    private static SoundClip gunshot;
    private static SoundClip fallSound;

    // create new sounds
    static{
        try { // create new soundclips and link to files
            gravityfallsMusic = new SoundClip("data/background.mp3");
            backgroundMusic = new SoundClip("data/elevator.mp3");
            roarSound = new SoundClip("data/roar.mp3");
            jumpSound = new SoundClip("data/jump.mp3");
            collectSound = new SoundClip("data/donkey.mp3");
            gunshot = new SoundClip("data/gunshot.mp3");
            fallSound = new SoundClip("data/fall.mp3");

        }
        catch (NullPointerException nullPointerException){
            System.out.println("Sound file not found, continuing without sound"); // in case of null pointer add message for no sound
        }
        catch(UnsupportedAudioFileException | IOException | LineUnavailableException e){
            System.out.println(e); // print exceptions
        }
    }

    // getters for sounds
    public static SoundClip getBackgroundMusic() {
        return backgroundMusic;
    }
    public static SoundClip getGravityFallsMusic(){return gravityfallsMusic;}
    public static SoundClip getRoarSound() {
        return roarSound;
    }
    public static SoundClip getJumpSound() {
        return jumpSound;
    }
    public static SoundClip getCollectSound(){ return collectSound; }
    public static SoundClip getGunshot(){ return gunshot; }
    public static SoundClip getFallSound(){return fallSound;}
}
