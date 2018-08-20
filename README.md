# WufooExporter
Extracts all data collected from every Wufoo form in an account.  We are using this to create an index of data to manage GDPR removal requests.

## How to Install
- Rename config-sample.inc to config.inc and add your API credentials from Wufoo
- Create a sub folder called export

## Run the App
- From the command line run
`php export.php`
- This will export all of your forms as json encoded values to the export folder

## A few notes
- We're pausing for 1 minute between form exports to prevent hittting the rate limit of the Wufoo API
- As a result of above if you have a lot of forms this script can take some time to run

## What do we use this for?
Wufoo doesn't offer a way to easily find email addresses across all of the forms in your account.  The latest European Union GDPR (General Data Protection Regulation) requires that you remove entries upon request by an EU citizen.

We use this tool to essentially build an index of all of our entires across forms.  We can then perform a command line search for that email address, locate all of the forms where the email is contained and then inside Wufoo remove those entries.

## How could this get better?
This script was developed rapidly.  There are ways that it could be improved in the future:
- Write to CSV - instead of json, this could allow for other uses including automated data importing to other apps
- Web front-end - providing a tool that allows for easy searching and a one-click removal without having to login to Wufoo
