package com.example.qrcodescanner.Scanner;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.example.qrcodescanner.R;

public class scanner_temperature extends AppCompatActivity {

    Button btnVSubmit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_scanner_temperature);

        btnVSubmit = findViewById(R.id.btnSubmit);

        btnVSubmit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(scanner_temperature.this, scanner_alert_in.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_CLEAR_TASK| Intent.FLAG_ACTIVITY_NEW_TASK);
                scanner_temperature.this.startActivity(intent);
            }
        });

    }
}