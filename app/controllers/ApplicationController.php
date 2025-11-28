<?php

/**
 * Base controller for the application.
 * Add general things in this controller.
 */
class ApplicationController extends Controller 
{
	public function ensureSession() {
        if(session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }
}
