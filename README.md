# 👩🏿‍⚕️ VCH Orientation Chatbot API

A backend UI and API for the VCH Orientation Chatbot that lives [here](http://vchorientation.ca).  It's goal is to provide answers to the common questions that new hires at VCH will have in a friendly and accessible way.


## 👩🏾‍⚕️ Terminology
- Intent: The category of thing that the user might be searching for (Eg.  Definitions of words would be an Intent, Links to forms would be another)
- Slots: A slot represents the thing that the user wants to know about (The actual word the user wants the definiton to, or the name of the form the user needs)


## 👩🏽‍⚕️ Technology
- Laravel: a php framework
- Vue: a frontend javascript framework that handles state and for the backend admin UI


## 👩🏼‍⚕️ Backend UI
The backend uses Vue and allows admins to add definitions and synonyms to terms

## 👩🏻‍⚕️ API

API endpoints are used both by the Backend UI to:
- View Intents, Slots and Synonyms
- Makes changes to Intents, Slots and Synonyms

And the Chatbot to:
- Provide intent and slot and get back a response