package com.example.qrcodescanner.admin;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.view.WindowManager;
import android.widget.ImageView;

import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;

public class user_profile extends AppCompatActivity {

    private long backPressTime;

    ImageView imgVBack;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().setFlags(WindowManager.LayoutParams.FLAG_FULLSCREEN, WindowManager.LayoutParams.FLAG_FULLSCREEN);
        setContentView(R.layout.activity_user_profile);

        imgVBack = findViewById(R.id.btnUserBack);

        imgVBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                getMain();
            }
        });
    }


    public  void  getMain(){
        Intent intent = new Intent(user_profile.this, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
        user_profile.this.startActivity(intent);
    }


    @Override
    public void onBackPressed() {
        if (backPressTime + 2000 > System.currentTimeMillis()){
            super.onBackPressed();
            return;
        }else {
            getMain();
        }
        backPressTime = System.currentTimeMillis();


    }


}