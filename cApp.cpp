#include "cApp.h"

// Generate main function with wxWidgets
wxIMPLEMENT_APP(cApp);

cApp::cApp()
{
}


cApp::~cApp()
{
}

bool cApp::OnInit()
{
	m_frame1 = new cMain();
	m_frame1->Show();

	return true;
}