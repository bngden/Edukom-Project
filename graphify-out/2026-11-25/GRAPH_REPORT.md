# Graph Report - Edukom-Project  (2026-11-25)

## Corpus Check
- Corpus is ~10,040 words - fits in a single context window. You may not need a graph.

## Summary
- 186 nodes · 202 edges · 24 communities (6 shown, 18 thin omitted)
- Extraction: 99% EXTRACTED · 1% INFERRED · 0% AMBIGUOUS · INFERRED: 3 edges (avg confidence: 0.85)
- Token cost: 52,587 input · 0 output

## Community Hubs (Navigation)
- Composer Package Config
- Frontend Build Dependencies
- Graphify & Task Logging Docs
- Database Migrations
- User Model & Seeding
- Cache Session & User Factory
- Composer Scripts
- App Bootstrap & Entry
- Composer Plugin Settings
- Service Providers
- Feature Tests
- Unit Tests
- Base Controller
- Robots Crawl Policy

## God Nodes (most connected - your core abstractions)
1. `scripts` - 9 edges
2. `User` - 8 edges
3. `require-dev` - 7 edges
4. `TASK 2026-11-25 Setup graphify knowledge graph` - 7 edges
5. `graphify (CLAUDE.md section)` - 6 edges
6. `AppServiceProvider` - 5 edges
7. `config` - 5 edges
8. `UserFactory` - 5 edges
9. `Log task (WAJIB)` - 5 edges
10. `require` - 4 edges

## Surprising Connections (you probably didn't know these)
- `TASK 2026-11-25 Setup graphify knowledge graph` --implements--> `Task log file format (docs/tasks/YYYY-MM-DD-slug.md)`  [INFERRED]
  docs/tasks/2026-11-25-setup-graphify.md → CLAUDE.md
- `Memory: TASK 2026-11-25 Setup graphify knowledge graph` --implements--> `graphify save-result memory step`  [INFERRED]
  graphify-out/memory/query_20261124_181742_110e102b_task_2026_11_25__setup_graphify_knowledge_graph.md → CLAUDE.md
- `Memory: TASK 2026-11-25 Setup graphify knowledge graph` --references--> `TASK 2026-11-25 Setup graphify knowledge graph`  [EXTRACTED]
  graphify-out/memory/query_20261124_181742_110e102b_task_2026_11_25__setup_graphify_knowledge_graph.md → docs/tasks/2026-11-25-setup-graphify.md
- `TASK 2026-11-25 Setup graphify knowledge graph` --references--> `graphify (CLAUDE.md section)`  [EXTRACTED]
  docs/tasks/2026-11-25-setup-graphify.md → CLAUDE.md
- `Laravel Boost` --semantically_similar_to--> `graphify (CLAUDE.md section)`  [INFERRED] [semantically similar]
  README.md → CLAUDE.md

## Import Cycles
- None detected.

## Hyperedges (group relationships)
- **Graphify task logging workflow** — claude_log_task_wajib, claude_task_log_format, claude_graphify_save_result, claude_graphify_update_after_modify, docs_tasks_2026_11_25_setup_graphify_task, graphify_out_memory_query_20261124_181742_110e102b_task_2026_11_25__setup_graphify_knowledge_graph_memory [INFERRED 0.85]

## Communities (24 total, 18 thin omitted)

### Community 0 - "Composer Package Config"
Cohesion: 0.06
Nodes (30): autoload, autoload-dev, psr-4, psr-4, description, extra, laravel, keywords (+22 more)

### Community 1 - "Frontend Build Dependencies"
Cohesion: 0.12
Nodes (19): devDependencies, axios@^1.11.0, concurrently@^9.0.1, laravel-vite-plugin@^2.0.0, tailwindcss@^4.0.0, @tailwindcss/vite@^4.0.0, vite@^7.0.7, private (+11 more)

### Community 2 - "Graphify & Task Logging Docs"
Cohesion: 0.11
Nodes (17): graphify (CLAUDE.md section), graphify reflect (LESSONS.md), graphify save-result memory step, Log task (WAJIB), python -m graphify invocation, Task log file format (docs/tasks/YYYY-MM-DD-slug.md), PreToolUse/SessionStart hooks (.claude/settings.json), graphify-out initial graph (graph.json, graph.html, GRAPH_REPORT.md) (+9 more)

### Community 3 - "Database Migrations"
Cohesion: 0.16
Nodes (8): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}()

### Community 6 - "Composer Scripts"
Cohesion: 0.22
Nodes (9): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+1 more)

### Community 8 - "Composer Plugin Settings"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

## Knowledge Gaps
- **8 isolated node(s):** `graphify reflect (LESSONS.md)`, `Agentic Development`, `Laracasts`, `MIT license`, `graphifyy 0.9.110 package` (+3 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 93 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **18 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `scripts` connect `Composer Scripts` to `Composer Package Config`?**
  _High betweenness centrality (0.020) - this node is a cross-community bridge._
- **What connects `graphify reflect (LESSONS.md)`, `Agentic Development`, `Laracasts` to the rest of the system?**
  _8 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Composer Package Config` be split into smaller, more focused modules?**
  _Cohesion score 0.06451612903225806 - nodes in this community are weakly interconnected._
- **Why does `config` connect `Composer Plugin Settings` to `Composer Package Config`?**
  _High betweenness centrality (0.015) - this node is a cross-community bridge._
- **Should `Frontend Build Dependencies` be split into smaller, more focused modules?**
  _Cohesion score 0.11857707509881422 - nodes in this community are weakly interconnected._
- **Should `Graphify & Task Logging Docs` be split into smaller, more focused modules?**
  _Cohesion score 0.10952380952380952 - nodes in this community are weakly interconnected._