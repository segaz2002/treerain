# Execution Guide

The entire task was implemented as a console Application. It is intended to be executed from a terminal.

### 1. Preparing the environment.

```
# Execute from MYSQL console
CREATE DATABASE raintree;

```
### 2. Create Tables (Migration)
From the terminal execute
    ```
        php main.php 1 up
    ```
This will create all the necessary tables for the next steps. There is any need to bring the table down, you also execute
    ```
        php main.php 1 down
    ```

### 3. Seeding .
From the terminal execute
    ```
        php main.php 1 seed
    ```
This is will load the tables with sample records.



NB: Do this before you continue to the other steps

<a href="http://www.youtube.com/watch?feature=player_embedded&v=olrOYcAvmic
" target="_blank"><img src="http://img.youtube.com/vi/olrOYcAvmic/0.jpg"
alt="IMAGE ALT TEXT HERE" width="240" height="180" border="10" /></a>