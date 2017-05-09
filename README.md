# Slack Workout Logger

A simple Slack integration where you can log how often you have done small workouts in the office.
Compete with your colleagues and see who is the most active!

Based on Slack Stairs Logger: https://github.com/exove-danny/slack-stairs-logger
## Installing

Start by setting up a custom integration in your Slack. Go to http://yourslackteamname.slack.com/apps/manage and then to Custom Integrations > Slash Commands > Add Configuration.

You can set up your custom integration here, make sure you fill at least these fields:
```
Command: /workout
URL: http://urlofyourchoice (make sure this point to the directory that later will contain this script)
Method: POST
```
All other fields can be filled in as you please.

Once you are done with this, save the integration. You are now done with the Slack side.

Next up is creating the database. Set up a MySQL database and import the install.sql script.

Last step is uploading the code to your server. Upload all 3 .php files to the folder specified in your Slack settings above, and modify config.php so it contains your database and Slack settings.

That is all! You are now ready to start logging!

## How to use it

Once you have this up and running you can use the following commands in your Slack:

List all commands:
```
/workout help
```

List workout entries for the current user:
```
/workout list [--all]
```

Additionally, you can add a command for each workout by editing the config.php file.

## License

This project is licensed under the GNU GENERAL PUBLIC LICENSE - see the [LICENSE.md](LICENSE.md) file for details
