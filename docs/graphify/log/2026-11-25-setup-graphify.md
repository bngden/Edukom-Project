# TASK 2026-11-25 — Setup graphify knowledge graph

- **Status:** selesai
- **Tujuan:** Memberi project peta (knowledge graph) agar agent bisa membaca struktur kode dan riwayat task.
- **Perubahan:**
  - Install paket `graphifyy` 0.9.110 (Python 3.10, `pip --user`) + skill `/graphify` di `~/.claude/skills`.
  - `graphify claude install` → section graphify di `CLAUDE.md` + hook PreToolUse/SessionStart di `.claude/settings.json` (memakai `python -m graphify`).
  - `.graphifyignore` (vendor, node_modules, storage, dll).
  - Graph awal: `graphify-out/` (graph.json, graph.html, GRAPH_REPORT.md).
  - Folder log task: `docs/tasks/`.
- **File terkait:** CLAUDE.md, .claude/settings.json, .graphifyignore, docs/tasks/
