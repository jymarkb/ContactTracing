package com.example.qrcodescanner.Common;

import androidx.appcompat.app.AppCompatActivity;
import androidx.viewpager.widget.ViewPager;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import com.example.qrcodescanner.Common.login.login;
import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;

public class Splash extends AppCompatActivity {

    public static ViewPager viewPager;
    SplashViewPagerAdapter adapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        viewPager = findViewById(R.id.viewpager);
        adapter = new SplashViewPagerAdapter(this);
        viewPager.setAdapter(adapter) ;

        if (isSeen()){
            Intent intent = new Intent(Splash.this, login.class);
            intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
            Splash.this.startActivity(intent);

        }else{
            SharedPreferences.Editor editor=getSharedPreferences("slide", MODE_PRIVATE).edit();
            editor.putBoolean("slide",true);
            editor.apply();
        }

    }

    private boolean isSeen() {
        SharedPreferences sharedPreferences=getSharedPreferences("slide",MODE_PRIVATE);
        return sharedPreferences.getBoolean("slide",false);
    }
}