const { google } = require('googleapis');
const credentials = require('/Users/kike/Downloads/client_secret_658012502114-33f1mbbvjbc7n409rgs4i8oe6prtikql.apps.googleusercontent.com.json');

const SCOPES = ['https://www.googleapis.com/auth/spreadsheets'];

async function authorize() {
    const oAuth2Client = new google.auth.OAuth2(
        credentials.installed.client_id,
        credentials.installed.client_secret,
        credentials.installed.redirect_uris[0]
    );

    const authUrl = oAuth2Client.generateAuthUrl({
        access_type: 'offline',
        scope: SCOPES,
    });

    console.log('Autoriza esta aplicación accediendo a esta URL:', authUrl);
}

authorize();
