
#include "Utils.h"
#include "stdafx.h"


BOOL GetDefaultWindowSize(LPRECT rect) {
	if (rect == NULL) {
		return FALSE;
	}
	rect->left = CW_USEDEFAULT;   // X 
	rect->top = CW_USEDEFAULT;    // Y
	rect->right = CW_USEDEFAULT;  // Width  use macro DEFLT_SIZE_WIDTH(rect)  to obtain it. Defined in Utils.h
	rect->bottom = CW_USEDEFAULT; // Height use macro DEFLT_SIZE_HEIGHT(rect) to obtain it. Defined in Utils.h 

	APPBARDATA traybar;  memset(&traybar, 0, sizeof(APPBARDATA)); traybar.cbSize = sizeof(APPBARDATA);
	UINT_PTR trayok = SHAppBarMessage(ABM_GETTASKBARPOS, &traybar);
	if (!trayok) {
		return FALSE;
	}
	BOOL success;
	POINT lpClickPoint;
	success = GetCursorPos(&lpClickPoint);
	if (!success) {
		return FALSE;
	}
	HMONITOR hMonitor = MonitorFromPoint(lpClickPoint, MONITOR_DEFAULTTONEAREST);
	if (hMonitor == NULL) {
		return FALSE;
	}
	MONITORINFOEX mi;  memset(&mi, 0, sizeof(MONITORINFOEX)); mi.cbSize = sizeof(MONITORINFOEX);
	success = GetMonitorInfo(hMonitor, &mi);
	if (!success) {
		return FALSE;
	}

	int width = 640;
	int height = 480;

	if (traybar.rc.top > mi.rcMonitor.top + height                 && mi.rcMonitor.right - mi.rcMonitor.left > width) {
		// Traybar is on bottom
		rect->left = mi.rcMonitor.right - width;
		rect->top  = traybar.rc.top - height;
	} else if (mi.rcMonitor.bottom > traybar.rc.bottom + height && mi.rcMonitor.right - mi.rcMonitor.left > width) {
		// Traybar is on top
		rect->left = mi.rcMonitor.right - width;
		rect->top  = traybar.rc.bottom;
	} else if (mi.rcMonitor.right > traybar.rc.right + width && traybar.rc.bottom - traybar.rc.top > height) {
		// Traybar is on the left
		rect->left = traybar.rc.right;
		rect->top  = mi.rcMonitor.bottom - height;
	} else if (traybar.rc.left > mi.rcMonitor.left + width && traybar.rc.bottom - traybar.rc.top > height) {
		// Traybar is on the right
		rect->left = traybar.rc.left - width;
		rect->top  = mi.rcMonitor.bottom - height;
	} else {
		rect->right = CW_USEDEFAULT;  // Width  use macro DEFLT_SIZE_WIDTH(rect)  to obtain it. Defined in Utils.h
		rect->bottom = CW_USEDEFAULT; // Height use macro DEFLT_SIZE_HEIGHT(rect) to obtain it. Defined in Utils.h 
		return FALSE;
	}

	rect->right = width;  
	rect->bottom = height; 

	return TRUE;
}