package com.example.qrcodescanner.Scanner;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.example.qrcodescanner.MainActivity;
import com.example.qrcodescanner.R;

public class scanner_alert_out extends AppCompatActivity {

    Button btnVAgain;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanner_alert_out);

        btnVAgain = findViewById(R.id.btnAgain);

        btnVAgain.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(scanner_alert_out.this, MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
                scanner_alert_out.this.startActivity(intent);
            }
        });
    }
}