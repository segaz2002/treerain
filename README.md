# Execution Guide

The entire task was implemented as a console Application. It is intended to be executed from a terminal.

### 1. Preparing the environment.

```
# Execute from MYSQL console
CREATE DATABASE raintree;

```
NB: Do this before you continue to the other steps

### 2. Create Tables (Migration)
From the terminal execute
    ```
        php main.php 1 up
    ```
This will create all the necessary tables for the next steps. There is any need to bring the table down, you also execute
    ```
        php main.php 1 down
    ```

### 3. Seeding.
From the terminal execute
    ```
        php main.php 1 seed
    ```
This is will load the tables with sample records.

### 4. Display Patient Record.
From the terminal execute
    ```
        php main.php 2 display
    ```
Patient records in the order and format specified in the requirement will be displayed on the terminal.

To Display the stats of characters in both first and last names of customers, execute from terminal
    ```
        php main.php 2 stat
    ```

### 5. Test file Execution (OOP part)
From the terminal execute
    ```
        php test.php
    ```
This will in turn display the records in the required format according to the requirement given;


Watch the demo below for more information.

# Video Demo Below
<a href="http://www.youtube.com/watch?feature=player_embedded&v=olrOYcAvmic
" target="_blank"><img src="http://img.youtube.com/vi/olrOYcAvmic/0.jpg"
alt="IMAGE ALT TEXT HERE" width="240" height="180" border="10" /></a>