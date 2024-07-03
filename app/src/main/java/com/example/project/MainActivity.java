package com.example.project;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;

import androidx.activity.EdgeToEdge;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.graphics.Insets;
import androidx.core.view.ViewCompat;
import androidx.core.view.WindowInsetsCompat;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        EdgeToEdge.enable(this);
        setContentView(R.layout.activity_main);
        ViewCompat.setOnApplyWindowInsetsListener(findViewById(R.id.registrar), (v, insets) -> {
            Insets systemBars = insets.getInsets(WindowInsetsCompat.Type.systemBars());
            v.setPadding(systemBars.left, systemBars.top, systemBars.right, systemBars.bottom);
            return insets;
        });
    }
    public void openMenuRegistro(View view) {
        Intent intent = new Intent(MainActivity.this, Registro.class);
        startActivity(intent);
        // Finalizar la actividad actual si es necesario
        finish();
    }

    public void openMenuInicio(View view) {
        Intent intent = new Intent(MainActivity.this, inicio.class);
        startActivity(intent);
        // Finalizar la actividad actual si es necesario
        finish();
    }
}