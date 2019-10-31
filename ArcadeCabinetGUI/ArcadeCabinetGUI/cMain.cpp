#include "cMain.h"

cMain::cMain() : wxFrame(nullptr, wxID_ANY, "HGD Arcade Cabinet", wxDefaultPosition, wxDefaultSize, wxFULLSCREEN_NOMENUBAR)
{
	// Set the window to full screen and colour.
	wxTopLevelWindow::Maximize(true);
	SetBackgroundColour(*wxWHITE);

	// Load and place the HGD logo.
	wxInitAllImageHandlers();
	logoHandler = new wxPNGHandler;
	wxImage::AddHandler(logoHandler);
	logoImage = new wxStaticBitmap(this, wxID_ANY, wxBitmap("C:/Users/Matthew/source/repos/ArcadeCabinetGUI/ArcadeCabinetGUI/Pictures/logo.png", wxBITMAP_TYPE_PNG), wxPoint(50, 100), wxSize(100, 500));
	logoImage->Show();

}


cMain::~cMain()
{
}
