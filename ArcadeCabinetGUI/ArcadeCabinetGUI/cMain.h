#pragma once

// Include wxWidgets library
#include "wx/wx.h"

// Windows Size functions
#include "wTypes.h"

class cMain : public wxFrame
{
public:
	cMain();
	~cMain();

	// Husky game logo variables
	wxPNGHandler* logoHandler;
	wxStaticBitmap* logoImage;

	// List box variables
	wxListBox* gameSelection;
};

