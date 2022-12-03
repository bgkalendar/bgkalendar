// SysTrayDemo.cpp : Defines the entry point for the application.
//

#include "stdafx.h"
#include "MainCalendar.h"
#include "commctrl.h"
#include "winuser.h"
#include <Windows.h>
#include <stdlib.h>
#include <string.h>
#include <tchar.h> // Or: remove this
#include <winnt.h> // Or: remove this
#include "Errors.h"
#include "Language.h"
#include "Utils.h"
         

#define IDC_MAIN_EDIT	101
// Child window identifier of the month calendar.
#define IDC_MONTHCAL 102

// Symbols used by SetWindowPos function (arbitrary values).
#define LEFT 35
#define TOP  40

#define MAX_LOADSTRING 100
#define	WM_USER_SHELLICON WM_USER + 1

// Global Variables:
HINSTANCE hInst;	// current instance
NOTIFYICONDATA nidApp;
HMENU hPopMenu;
TCHAR szTitle[MAX_LOADSTRING];					// The title bar text
TCHAR szWindowClass[MAX_LOADSTRING];			// the main window class name
TCHAR szApplicationToolTip[MAX_LOADSTRING];	    // the main window class name
BOOL bDisable = FALSE;							// keep application state

void handleShellExecuteErrors(HWND, HINSTANCE);

BOOL				InitApplication(HINSTANCE hInstance);
BOOL				InitInstance(HINSTANCE, int);
LRESULT CALLBACK	WndProcTray(HWND, UINT, WPARAM, LPARAM);
LRESULT CALLBACK    WndProcCalendar(HWND, UINT, WPARAM, LPARAM);
INT_PTR CALLBACK	About(HWND, UINT, WPARAM, LPARAM);


static TCHAR WindowClass[] = TEXT("Window");

ATOM TrayWindowClass;
ATOM CalendarWindowClass;

int APIENTRY _tWinMain(HINSTANCE hInstance,
                     HINSTANCE hPrevInstance,
                     LPTSTR    lpCmdLine,
                     int       nCmdShow)
{
	UNREFERENCED_PARAMETER(hPrevInstance);
	UNREFERENCED_PARAMETER(lpCmdLine);

 	// TODO: Place code here.
	MSG msg;
	HACCEL hAccelTable;

	// Initialize global strings
	LoadString(hInstance, IDS_APP_TITLE, szTitle, MAX_LOADSTRING);
	LoadString(hInstance, IDC_SYSTRAYDEMO, szWindowClass, MAX_LOADSTRING);
	
	InitApplication(hInstance);

	// Perform application initialization:
	if (!InitInstance (hInstance, nCmdShow))
	{
		return FALSE;
	}

	hAccelTable = LoadAccelerators(hInstance, MAKEINTRESOURCE(IDC_SYSTRAYDEMO));

	// Main message loop:
	while (GetMessage(&msg, NULL, 0, 0))
	{
		if (!TranslateAccelerator(msg.hwnd, hAccelTable, &msg))
		{
			TranslateMessage(&msg);
			DispatchMessage(&msg);
		}
	}

	return (int) msg.wParam;
}



//
//  FUNCTION: MyRegisterClass()
//
//  PURPOSE: Registers the window class.
//
//  COMMENTS:
//
//    This function and its usage are only necessary if you want this code
//    to be compatible with Win32 systems prior to the 'RegisterClassEx'
//    function that was added to Windows 95. It is important to call this function
//    so that the application will get 'well formed' small icons associated
//    with it.
//
BOOL InitApplication(HINSTANCE hInstance)
{

	ATOM result = (ATOM)0;

	WNDCLASSEX wcex;

	wcex.cbSize = sizeof(WNDCLASSEX);

	wcex.style			= CS_HREDRAW | CS_VREDRAW;
	wcex.lpfnWndProc	= WndProcTray;
	wcex.cbClsExtra		= 0;
	wcex.cbWndExtra		= 0;
	wcex.hInstance		= hInstance;
	wcex.hIcon			= LoadIcon(hInstance, MAKEINTRESOURCE(IDI_SYSTRAYDEMO));
	wcex.hCursor		= LoadCursor(NULL, IDC_ARROW);
	wcex.hbrBackground	= (HBRUSH)(COLOR_WINDOW+1);
	wcex.lpszMenuName	= MAKEINTRESOURCE(IDC_SYSTRAYDEMO);
	wcex.lpszClassName	= szWindowClass;
	wcex.hIconSm		= LoadIcon(wcex.hInstance, MAKEINTRESOURCE(IDI_SMALL));

	TrayWindowClass = RegisterClassEx(&wcex);

	WNDCLASSEX wclass = { 0 }; // Or: WNDCLASSEXW
	wclass.cbSize = sizeof(wclass);
	wclass.style = CS_CLASSDC | CS_DBLCLKS | CS_DROPSHADOW | CS_HREDRAW | CS_VREDRAW | CS_SAVEBITS;
	wclass.lpfnWndProc = &WndProcCalendar;
	wclass.cbClsExtra = 0;
	wclass.cbWndExtra = 0;
	wclass.hInstance = hInstance;
	wclass.hIcon = NULL; // TODO: CREATE ICON
	wclass.hCursor = NULL;
	wclass.hbrBackground = (HBRUSH)COLOR_APPWORKSPACE; // (HBRUSH)(COLOR_WINDOW + 1);
	wclass.lpszMenuName = NULL;
	wclass.lpszClassName = WindowClass;
	wclass.hIconSm = NULL;

	CalendarWindowClass = RegisterClassEx(&wclass);

	if (TrayWindowClass == (ATOM)0 || CalendarWindowClass == (ATOM)0) {
		return FALSE;
	} else {
		return TRUE;
	}

}


//
//   FUNCTION: InitInstance(HINSTANCE, int)
//
//   PURPOSE: Saves instance handle and creates main window
//
//   COMMENTS:
//
//        In this function, we save the instance handle in a global variable and
//        create and display the main program window.
//
BOOL InitInstance(HINSTANCE hInstance, int nCmdShow)
{
   HWND hWnd;
   HICON hMainIcon;

   hInst = hInstance; // Store instance handle in our global variable

   hWnd = CreateWindow(szWindowClass, szTitle, WS_OVERLAPPEDWINDOW,
      CW_USEDEFAULT, 0, CW_USEDEFAULT, 0, NULL, NULL, hInstance, NULL);

   if (!hWnd)
   {
      return FALSE;
   }

   hMainIcon = LoadIcon(hInstance,(LPCTSTR)MAKEINTRESOURCE(IDI_SYSTRAYDEMO)); 

   nidApp.cbSize = sizeof(NOTIFYICONDATA); // sizeof the struct in bytes 
   nidApp.hWnd = (HWND) hWnd;              //handle of the window which will process this app. messages 
   nidApp.uID = IDI_SYSTRAYDEMO;           //ID of the icon that willl appear in the system tray 
   nidApp.uFlags = NIF_ICON | NIF_MESSAGE | NIF_TIP; //ORing of all the flags 
   nidApp.hIcon = hMainIcon; // handle of the Icon to be displayed, obtained from LoadIcon 
   nidApp.uCallbackMessage = WM_USER_SHELLICON; 
   LoadString(hInstance, IDS_APPTOOLTIP,nidApp.szTip,MAX_LOADSTRING);
   Shell_NotifyIcon(NIM_ADD, &nidApp); 

   return TRUE;
}

void DestroyApp() {
	HINSTANCE hInstance = GetModuleHandle(NULL);
	if (TrayWindowClass != (ATOM)0) {
		UnregisterClass((LPCWSTR)TrayWindowClass, hInstance);
	}
	if (CalendarWindowClass != (ATOM)0) {
		UnregisterClass((LPCWSTR)CalendarWindowClass, hInstance);
	}
}


LRESULT CALLBACK WndProcCalendar(HWND hWnd, UINT message, WPARAM wParam, LPARAM lParam)
{
	switch (message)
	{/*
	  case WM_SIZE:    HWND hEdit; RECT rcClient;
		               GetClientRect(hWnd, &rcClient);
		               hEdit = GetDlgItem(hWnd, IDC_MAIN_EDIT);
		               SetWindowPos(hEdit, NULL, 0, 0, rcClient.right, rcClient.bottom, SWP_NOZORDER);	               
	                   break; */
	  case WM_PAINT:
	  case WM_DESTROY:
	  case WM_COMMAND:
			;
	   default:
		   ;
	}
	return DefWindowProc(hWnd, message, wParam, lParam);
}
HWND hMainWnd = NULL;
BOOL OpenMainWindow() {
	

	if (hMainWnd != NULL) {
		ShowWindow(hMainWnd, SW_SHOW | SW_SHOWNORMAL);
		//success = GetWindowRect(hMainWnd, &rect);
		SetWindowPos(hMainWnd, HWND_TOP, 0, 0, 0, 0, SWP_NOMOVE | SWP_NOSIZE);
		SetFocus(hMainWnd);
		return GetLastError() == (DWORD)0;
	}
	
	RECT rcDfltSize;
	GetDefaultWindowSize(&rcDfltSize);

	HINSTANCE hInstance = GetModuleHandle(NULL);	




	hMainWnd = CreateWindow( // Or: CreateWindowW()
		(LPCTSTR)CalendarWindowClass, //WindowClass,
		TEXT("Bulgarian vs Gregorian Calendar [https://bgkalendar.com]"), // Or: L"NAME OF WINDOW"
		0 ,
		rcDfltSize.left,
		rcDfltSize.top,
		DEFLT_SIZE_WIDTH(rcDfltSize),
		DEFLT_SIZE_HEIGHT(rcDfltSize),
		0,
		0,
		hInstance,
		0
	);
	SetWindowLong(hMainWnd, GWL_STYLE, WS_BORDER);

	if (!hMainWnd)
	{
		// error! Use GetLastError() to find out why...
		return 0;
	}

	ShowWindow(hMainWnd, SW_SHOW | SW_SHOWNORMAL);
	UpdateWindow(hMainWnd);
	return TRUE;
}


//
//  FUNCTION: WndProc(HWND, UINT, WPARAM, LPARAM)
//
//  PURPOSE:  Processes messages for the main window.
//
//  WM_COMMAND	- process the application menu
//  WM_PAINT	- Paint the main window
//  WM_DESTROY	- post a quit message and return
//
//
LRESULT CALLBACK WndProcTray(HWND hWnd, UINT message, WPARAM wParam, LPARAM lParam)
{
	int wmId, wmEvent;
    POINT lpClickPoint;
	UINT uFlag;
	HINSTANCE openbrowserop;

	switch (message)
	{

	case WM_USER_SHELLICON: 
		// systray msg callback 
		switch(LOWORD(lParam)) 
		{   

		    case WM_RBUTTONDOWN:
				uFlag = MF_BYPOSITION | MF_STRING;
				GetCursorPos(&lpClickPoint);
				hPopMenu = CreatePopupMenu();
				InsertMenu(hPopMenu, 0xFFFFFFFF, MF_BYPOSITION | MF_STRING, IDM_ABOUT, _T("About"));
				InsertMenu(hPopMenu, 0xFFFFFFFF, MF_BYPOSITION | MF_STRING, IDM_TEST1, _T("Go to Site"));
				//InsertMenu(hPopMenu, 0xFFFFFFFF, MF_BYPOSITION | MF_STRING, IDM_TEST2, _T("Check For Updates"));
				InsertMenu(hPopMenu, 0xFFFFFFFF, MF_SEPARATOR,              IDM_SEP,   _T("SEP"));

			    InsertMenu(hPopMenu, 0xFFFFFFFF, MF_BYPOSITION | MF_STRING, IDM_TEST3,_T("2018-09-06"));
				
				InsertMenu(hPopMenu, 0xFFFFFFFF, MF_SEPARATOR,              IDM_SEP,_T("SEP"));
				InsertMenu(hPopMenu, 0xFFFFFFFF, MF_BYPOSITION | MF_STRING, IDM_EXIT,_T("Exit"));

				SetForegroundWindow(hWnd);
				TrackPopupMenu(hPopMenu,TPM_LEFTALIGN|TPM_LEFTBUTTON|TPM_BOTTOMALIGN,lpClickPoint.x, lpClickPoint.y,0,hWnd,NULL);
				return TRUE;

		    case WM_LBUTTONDOWN:

				return OpenMainWindow();

				/*
				char* message = "Test message - Йордан Неделчев";
				WCHAR msg[500];
				memset(msg, 0, 500);
				int 
				result = MultiByteToWideChar(CP_UTF8, MB_ERR_INVALID_CHARS, message, -1, (LPWSTR)msg, 500);
				if (result <= 0) {
					ExitProcess(0);
				}

				result = MessageBoxA(hWnd, (LPCSTR)"Йордан Драгоев", (LPCSTR)"Calendar", MB_OK);
				if (result == IDOK) {
					//ExitProcess((UINT)0);
				} */				
		}
		break;
	case WM_COMMAND:
		wmId    = LOWORD(wParam);
		wmEvent = HIWORD(wParam);
		// Parse the menu selections:
		switch (wmId)
		{
			case IDM_ABOUT:
				DialogBox(hInst, MAKEINTRESOURCE(IDD_ABOUTBOX), hWnd, About);
				break;
			case IDM_TEST1:
				openbrowserop = 
				ShellExecuteA(
					hWnd, 
					"open", 
					tr("https://bgkalendar.com", "https://bgkalendar.com?lang=en", "https://bgkalendar.com?lang=de", "https://bgkalendar.com?lang=ru"),
					NULL, NULL, 
					SW_MAXIMIZE | SW_SHOWMAXIMIZED
				);
				if((int)openbrowserop <= 32) {
					handleShellExecuteErrors(hWnd, openbrowserop);
				}
				break;
			case IDM_TEST2:
				MessageBox(NULL,_T("This is a test for menu Test 2"),_T("Test 2"),MB_OK);
				break;
			case IDM_TEST3:
				return OpenMainWindow();
			case IDM_DISABLE:
				bDisable = TRUE;
				break;
			case IDM_ENABLE:
				bDisable = FALSE;
				break;
			case IDM_EXIT:
				Shell_NotifyIcon(NIM_DELETE,&nidApp);
				DestroyWindow(hWnd);
				break;
			default:
				return DefWindowProc(hWnd, message, wParam, lParam);
		}
		break;
		/*
	case WM_PAINT:
		hdc = BeginPaint(hWnd, &ps);
		// TODO: Add any drawing code here...
		EndPaint(hWnd, &ps);
		break;*/
	case WM_DESTROY:
		DestroyApp();
		PostQuitMessage(0);
		break;
	default:
		return DefWindowProc(hWnd, message, wParam, lParam);
	}
	return 0;
}

// Message handler for about box.
INT_PTR CALLBACK About(HWND hDlg, UINT message, WPARAM wParam, LPARAM lParam)
{
	UNREFERENCED_PARAMETER(lParam);
	switch (message)
	{
	case WM_INITDIALOG:
		return (INT_PTR)TRUE;

	case WM_COMMAND:
		if (LOWORD(wParam) == IDOK || LOWORD(wParam) == IDCANCEL)
		{
			EndDialog(hDlg, LOWORD(wParam));
			return (INT_PTR)TRUE;
		}
		break;
	}
	return (INT_PTR)FALSE;
}

