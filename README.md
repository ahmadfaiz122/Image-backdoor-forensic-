# Image Backdoor Forensics & Mitigation Guide

[![Medium Article](https://img.shields.io/badge/Medium-Article-blue?logo=medium)](https://medium.com/@ahmadfaizabdilla/mengungkap-backdoor-shell-di-file-image-forensik-dan-mitigasi-8926bdd58284) [![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

## Overview
This repository is an educational resource based on a real-world cybersecurity incident I investigated during my industrial internship (PKL) as a vocational high school student in Computer and Network Engineering at a government institution in Pasuruan, Indonesia. 

The case: A website was compromised, redirecting users to online gambling sites via malicious image uploads containing hidden PHP webshells (e.g., "0byt3m1n1"). Images like JPEGs appeared harmless but hid backdoors through techniques like payload appending.

**Goal**: Teach digital forensics for detecting backdoors in images (JPG/PNG) and implementing mitigations. Perfect for students, devs, and infosec beginners.

## Why Images Can Hide Backdoors
- **Payload Appending**: Malicious PHP code added after the image's end marker (e.g., `FFD9` in JPEG). File remains valid as an image.
- **Steganography**: Code embedded in pixels or metadata (e.g., EXIF) without visual changes.
- **Metadata Injection**: Scripts hidden in headers like IPTC/XMP.

These bypass weak upload validations (extension/MIME checks only).

In my case: A 1061x1061 JPEG with empty metadata (modified July 2022) contained a full webshell.

## Quick Start
1. Clone the repo: `git clone https://github.com/yourusername/Image-Backdoor-Forensics.git`
2. Install tools: See [resources/tools.md](resources/tools.md)
3. Run forensics: `./forensics/analyze_image.sh samples/suspicious.jpg`
4. Sanitize: `python mitigation/sanitize_image.py samples/suspicious.jpg output_clean.jpg`

## Forensic Steps (From My PKL Investigation)
Follow these to analyze suspicious images:

1. **Verify File Type**  
   ```bash
   file suspicious.jpg
   # Output: JPEG image data, JFIF standard 1.01... (valid, but check size/metadata)
   ```

2. **Extract Strings**
   ```bash
   strings suspicious.jpg | grep -i "<?php"
# Reveals appended webshell code

3. **Inspect Metadata**
   ```bash 
   exiftool suspicious.jpg
   
# Empty EXIF? Red flag!

4. **Scan for malware**
   - Upload to VirusTotal
   - Local: clamscan suspicious.jpg
